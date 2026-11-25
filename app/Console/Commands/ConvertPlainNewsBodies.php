<?php

namespace App\Console\Commands;

use App\Models\News;
use Illuminate\Console\Command;

class ConvertPlainNewsBodies extends Command
{
    protected $signature = 'news:convert-plain-bodies {--write : Save the changes (without it, only a preview is shown)}';

    protected $description = 'One-time: turn plain-text news bodies into HTML paragraphs for the rich text editor';

    public function handle(): int
    {
        $changes = [];

        foreach (News::all() as $news) {
            foreach (['en', 'sw'] as $locale) {
                $text = (string) $news->getTranslation('body', $locale, false);

                if (trim($text) === '' || preg_match('/<\/?[a-z][a-z0-9]*[\s>\/]/i', $text)) {
                    continue;
                }

                $changes[] = [$news, $locale, $this->toHtml($text)];
            }
        }

        if (! $changes) {
            $this->info('Nothing to convert: every body is empty or already HTML.');

            return self::SUCCESS;
        }

        foreach ($changes as [$news, $locale, $html]) {
            $this->line("Post {$news->id} [{$locale}]: " . substr_count($html, '<p>') . ' paragraphs');
            $this->line('   ' . mb_substr(strip_tags($html), 0, 90) . '...');
        }

        if (! $this->option('write')) {
            $this->warn('Dry run only. Re-run with --write to save.');

            return self::SUCCESS;
        }

        if (! $this->confirm('Save ' . count($changes) . ' conversions?')) {
            return self::SUCCESS;
        }

        foreach ($changes as [$news, $locale, $html]) {
            $news->setTranslation('body', $locale, $html);
        }

        collect($changes)->pluck(0)->unique('id')->each->save();

        $this->info('Done.');

        return self::SUCCESS;
    }

    private function toHtml(string $text): string
    {
        $text = trim(str_replace(["\r\n", "\r"], "\n", $text));
        $blocks = preg_split('/\n{2,}/', $text);

        // No blank lines at all: treat every line as its own paragraph.
        if (count($blocks) === 1) {
            $blocks = preg_split('/\n/', $text);
        }

        return collect($blocks)
            ->map(fn ($block) => trim($block))
            ->filter()
            ->map(fn ($block) => '<p>' . nl2br(htmlspecialchars($block, ENT_NOQUOTES, 'UTF-8'), false) . '</p>')
            ->implode("\n");
    }
}
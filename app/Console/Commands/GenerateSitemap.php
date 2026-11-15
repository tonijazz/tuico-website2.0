<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Psr\Http\Message\UriInterface;
use Spatie\Sitemap\SitemapGenerator;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';

    protected $description = 'Crawl the public site and write public/sitemap.xml';

    public function handle(): int
    {
        $url = rtrim(config('app.url'), '/');

        // Only the live site has a public sitemap; test is password protected.
        if (str_contains($url, '//test.')) {
            $this->info('Skipped: this is the test site.');

            return self::SUCCESS;
        }

        $skip = ['/admin', '/storage', '/livewire', '/build', '/tuico-test-web'];

        SitemapGenerator::create($url)
            ->setConcurrency(3)
            ->setMaximumCrawlCount(1000)
            ->shouldCrawl(function (UriInterface $uri) use ($skip) {
                foreach ($skip as $prefix) {
                    if (str_starts_with($uri->getPath(), $prefix)) {
                        return false;
                    }
                }

                return true;
            })
            ->writeToFile(public_path('sitemap.xml'));

        $count = substr_count(file_get_contents(public_path('sitemap.xml')), '<url>');
        $this->info("Sitemap written with {$count} URLs.");

        return self::SUCCESS;
    }
}
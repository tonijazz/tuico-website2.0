<?php

namespace App\Http\ViewComposers;

use App\Models\QuickLink;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class QuickLinksComposer
{
    /** Footer links, loaded once per request and then reused. */
    private ?Collection $links = null;

    public function compose(View $view): void
    {
        $this->links ??= QuickLink::whereIn('location', ['footer_important', 'footer_partners'])
            ->orderBy('order')
            ->get()
            ->groupBy('location');

        $view->with('footerImportantLinks', $this->links->get('footer_important', collect()));
        $view->with('footerPartnerLinks', $this->links->get('footer_partners', collect()));
    }
}

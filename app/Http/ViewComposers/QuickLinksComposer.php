<?php

namespace App\Http\ViewComposers;

use App\Models\QuickLink;
use Illuminate\View\View;

class QuickLinksComposer
{
    public function compose(View $view): void
    {
        $view->with('footerImportantLinks', QuickLink::where('location', 'footer_important')->orderBy('order')->get());
        $view->with('footerPartnerLinks', QuickLink::where('location', 'footer_partners')->orderBy('order')->get());
    }
}

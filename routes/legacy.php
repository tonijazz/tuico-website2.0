<?php

use Illuminate\Support\Facades\Route;

// Addresses of the retired legacy site -> the matching new pages (301)
$redirects = [
    // English
    'about.php'                        => '/about',
    'contactus.php'                    => '/contact',
    'joinus.php'                       => '/join-us',
    'sector.php'                       => '/sectors',
    'services.php'                     => '/sectors',
    'tuico-affiliates.php'             => '/affiliations',
    'faqs.html'                        => '/faq',
    'howto.php'                        => '/faq',
    'howdos/howto.php'                 => '/faq',
    'biography.php'                    => '/leadership',
    'biographies/biography.php'        => '/leadership',
    'publications/publications.php'    => '/resources',
    'publications/constitution-tuico-1995.pdf' => '/resources',
    'tuico-publications.php'           => '/resources',
    'news/news.php'                    => '/news',
    'tuico-news.php'                   => '/news',
    'tuico-read-news.php'              => '/news',
    'tuico-offices.php'                => '/regions',

    // Kiswahili
    'sw/index.php'                     => '/sw',
    'sw/about.php'                     => '/sw/about',
    'sw/contactus.php'                 => '/sw/contact',
    'sw/joinus.php'                    => '/sw/join-us',
    'sw/sector.php'                    => '/sw/sectors',
    'sw/services.php'                  => '/sw/sectors',
    'sw/tuico-affiliates.php'          => '/sw/affiliations',
    'sw/faqs.html'                     => '/sw/faq',
    'sw/howto.php'                     => '/sw/faq',
    'sw/biography.php'                 => '/sw/leadership',
    'sw/publications.html'             => '/sw/resources',
    'sw/tuico-publications.php'        => '/sw/resources',
    'sw/news.html'                     => '/sw/news',
    'sw/tuico-news.php'                => '/sw/news',
    'sw/tuico-read-news.php'           => '/sw/news',
    'sw/speeches.html'                 => '/sw/news',
    'sw/tenders.html'                  => '/sw/resources',
    'sw/tuico-offices.php'             => '/sw/regions',
];

foreach ($redirects as $old => $new) {
    Route::permanentRedirect('/' . $old, $new);
}

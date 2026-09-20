<?php

use App\Http\Controllers\AffiliationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JoinUsController;
use App\Http\Controllers\LeaderController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OfficeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\ResourceItemController;
use Illuminate\Support\Facades\Route;

$pageRoutes = function () {
    Route::get('/test', function () {
        return view('test');
    });

    Route::get('/', [HomeController::class, 'index']);
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');
    Route::get('/affiliations', [AffiliationController::class, 'index'])->name('affiliations.index');
    Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
    Route::get('/resources', [ResourceItemController::class, 'index'])->name('resources.index');
    Route::get('/strategic-plan', [ProgrammeController::class, 'index'])->name('programmes.index');
    Route::get('/leadership', [LeaderController::class, 'index'])->name('leadership.index');
    Route::get('/regions', [OfficeController::class, 'regions'])->name('regions.index');
    Route::get('/regions/{slug}', [OfficeController::class, 'showRegion'])->name('regions.show');
    Route::get('/zones', [OfficeController::class, 'zones'])->name('zones.index');
    Route::get('/zones/{slug}', [OfficeController::class, 'showZone'])->name('zones.show');
    Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
    Route::get('/join-us', [JoinUsController::class, 'create'])->name('join-us.create');
    Route::post('/join-us', [JoinUsController::class, 'store'])->name('join-us.store');
    Route::get('/events', [EventController::class, 'index'])->name('events.index');

    Route::get('/{slug}', [PageController::class, 'show'])
    ->where('slug', '^(?!sw$|sw/).*')
    ->name('pages.show');
};

$pageRoutes();

Route::prefix('sw')->group($pageRoutes);

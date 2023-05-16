<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AuthController as BAuth;
use App\Http\Controllers\Backend\AboutController as BAbout;
use App\Http\Controllers\Backend\CategoryController as BCategory;
use App\Http\Controllers\Backend\ContactController as BContact;
use App\Http\Controllers\Backend\HomeController as BHome;
use App\Http\Controllers\Backend\LanguageController as LChangeLan;
use App\Http\Controllers\Backend\SettingController as BSetting;
use App\Http\Controllers\Backend\SiteLanguageController as BSiteLan;
use App\Http\Controllers\Backend\AdminController as BAdmin;
use App\Http\Controllers\Backend\InformationController as BInformation;
use App\Http\Controllers\Backend\MetaController as BMeta;
use App\Http\Controllers\Backend\NewsletterController as BNewsletter;
use App\Http\Controllers\Backend\ReportController as BReport;
use App\Http\Controllers\Backend\SliderController as BSlider;
use App\Http\Controllers\Backend\PermissionController as BPermission;

Route::group(['middleware' => 'auth:admin', 'as' => 'backend.'], function () {
//General
    Route::get('change-language/{lang}', [LChangeLan::class, 'switchLang'])->name('switchLang');
    Route::get('/', [BHome::class, 'index'])->name('index');
    Route::get('dashboard', [BHome::class, 'index'])->name('dashboard');
    Route::get('reports', [BReport::class, 'index'])->name('report');
    Route::get('give-permission', [BPermission::class, 'givePermission'])->name('givePermission');
    Route::get('give-permission-to-user/{user}', [BPermission::class, 'giveUserPermission'])->name('giveUserPermission');
    Route::get('contact-us/{id}/read', [BContact::class, 'readContact'])->name('readContact');
    Route::post('give-permission-to-user-update', [BPermission::class, 'giveUserPermissionUpdate'])->name('givePermissionUserUpdate');
    Route::get('slider/{id}/change-order', [BSlider::class, 'sliderOrder'])->name('sliderOrder');
    Route::get('newsletter/history', [BNewsletter::class, 'newsletterHistory'])->name('newsletterHistory');
    Route::post('change-category', [\App\Http\Controllers\Backend\ContentController::class, 'changeCategory'])->name('changeCategory');
    Route::post('change-alt-category', [\App\Http\Controllers\Backend\ContentController::class, 'changeAltCategory'])->name('changeAltCategory');
    Route::get('gallery/{id}/photos', [\App\Http\Controllers\Backend\GalleryController::class, 'photos'])->name('gallery.photos');
    Route::get('gallery/photos/{id}/delete', [\App\Http\Controllers\Backend\GalleryController::class, 'photosDelete'])->name('gallery.photos.delete');
    Route::post('gallery/{id}/photos/store', [\App\Http\Controllers\Backend\GalleryController::class, 'photosStore'])->name('gallery.photos.store');
    Route::group(['name' => 'status'], function () {
        Route::get('video/{id}/change-status', [App\Http\Controllers\Backend\VideoController::class, 'status'])->name('videoStatus');
        Route::get('writer/{id}/change-status', [App\Http\Controllers\Backend\WriterController::class, 'status'])->name('writerStatus');
        Route::get('writer/{id}/change-status', [App\Http\Controllers\Backend\WriterController::class, 'status'])->name('writerStatus');
        Route::get('gallery/{id}/change-status', [App\Http\Controllers\Backend\GalleryController::class, 'status'])->name('galleryStatus');
        Route::get('about/{id}/change-status', [App\Http\Controllers\Backend\AboutController::class, 'status'])->name('aboutStatus');
        Route::get('content/{id}/change-status', [App\Http\Controllers\Backend\ContentController::class, 'status'])->name('contentStatus');
        Route::get('/site-language/{id}/change-status', [BSiteLan::class, 'siteLanStatus'])->name('siteLanStatus');
        Route::get('/categories/{id}/change-status', [BCategory::class, 'categoryStatus'])->name('categoryStatus');
        Route::get('/settings/{id}/change-status', [BSetting::class, 'settingStatus'])->name('settingsStatus');
        Route::get('/seo/{id}/change-status', [BMeta::class, 'seoStatus'])->name('seoStatus');
        Route::get('/slider/{id}/change-status', [BSlider::class, 'sliderStatus'])->name('sliderStatus');
        Route::get('/useful-link/{id}/change-status', [\App\Http\Controllers\Backend\UsefulLinkController::class, 'status'])->name('statusLink');
    });
    Route::group(['name' => 'delete'], function () {
        Route::get('video/{id}/delete', [App\Http\Controllers\Backend\VideoController::class, 'delete'])->name('videoDelete');
        Route::get('writer/{id}/delete', [App\Http\Controllers\Backend\WriterController::class, 'delete'])->name('writerDelete');
        Route::get('writer/{id}/delete', [App\Http\Controllers\Backend\WriterController::class, 'delete'])->name('writerDelete');
        Route::get('gallery/{id}/delete', [App\Http\Controllers\Backend\GalleryController::class, 'delete'])->name('galleryDelete');
        Route::get('about/{id}/delete', [App\Http\Controllers\Backend\AboutController::class, 'delete'])->name('aboutDelete');
        Route::get('content/{id}/delete', [App\Http\Controllers\Backend\ContentController::class, 'delete'])->name('contentDelete');
        Route::get('content/photo/{id}/delete', [App\Http\Controllers\Backend\ContentController::class, 'deletePhoto'])->name('contentPhotoDelete');
        Route::get('/site-languages/{id}/delete', [BSiteLan::class, 'delSiteLang'])->name('delSiteLang');
        Route::get('/categories/{id}/delete', [BCategory::class, 'delCategory'])->name('delCategory');
        Route::get('/contact-us/{id}/delete', [BContact::class, 'delContactUS'])->name('delContactUS');
        Route::get('/settings/{id}/delete', [BSetting::class, 'delSetting'])->name('settingsDelete');
        Route::get('/users/{id}/delete', [BAdmin::class, 'delAdmin'])->name('delAdmin');
        Route::get('/seo/{id}/delete', [BMeta::class, 'delSeo'])->name('delSeo');
        Route::get('/slider/{id}/delete', [BSlider::class, 'delSlider'])->name('sliderDelete');
        Route::get('/report/{id}/delete', [BReport::class, 'delReport'])->name('delReport');
        Route::get('/report/clean-all', [BReport::class, 'cleanAllReport'])->name('cleanAllReport');
        Route::get('/permission/{id}/delete', [BPermission::class, 'delPermission'])->name('delPermission');
        Route::get('/newsletter/{id}/delete', [BNewsletter::class, 'delNewsletter'])->name('delNewsletter');
        Route::get('/useful-links/{id}/delete', [\App\Http\Controllers\Backend\UsefulLinkController::class, 'delete'])->name('delLinks');
    });
    Route::group(['name' => 'resource'], function () {
        Route::resource('/video', App\Http\Controllers\Backend\VideoController::class);
        Route::resource('/writer', App\Http\Controllers\Backend\WriterController::class);
        Route::resource('/writer', App\Http\Controllers\Backend\WriterController::class);
        Route::resource('/gallery', App\Http\Controllers\Backend\GalleryController::class);
        Route::resource('/content', App\Http\Controllers\Backend\ContentController::class);
        Route::resource('/categories', BCategory::class);
        Route::resource('/site-languages', BSiteLan::class);
        Route::resource('/contact-us', BContact::class);
        Route::resource('/about', BAbout::class);
        Route::resource('/settings', BSetting::class);
        Route::resource('/users', BAdmin::class);
        Route::resource('/informations', BInformation::class);
        Route::resource('/seo', BMeta::class);
        Route::resource('/newsletter', BNewsletter::class);
        Route::resource('/slider', BSlider::class);
        Route::resource('/permissions', BPermission::class);
        Route::resource('/useful-links', \App\Http\Controllers\Backend\UsefulLinkController::class);
    });
});
Route::fallback(function () {
    return view('backend.errors.404');
});
Route::group(['name' => 'auth'], function () {
    Route::get('/login', [BAuth::class, 'showLoginForm'])->name('login');
    Route::post('loginAdmin', [BAuth::class, 'login'])->name('loginPost');
    Route::post('logout', [BAuth::class, 'logout'])->name('logout');
});

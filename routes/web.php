<?php

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AtletController;
use App\Http\Controllers\JudgeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NomorController;
use App\Http\Controllers\SportController;
use App\Http\Controllers\EmployController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\RefereeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TrainnerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontNewsController;
use App\Http\Controllers\RoleSportController;
use App\Http\Controllers\AtletinClubController;
use App\Http\Controllers\ClubGalleryController;
use App\Http\Controllers\FrontSportsController;
use App\Http\Controllers\JudgeInClubController;
use App\Http\Controllers\NewsRequestController;
use App\Http\Controllers\CategoryNewsController;
use App\Http\Controllers\FrontendHomeController;
use App\Http\Controllers\FrontGalleryController;
use App\Http\Controllers\SportGalleryController;
use App\Http\Controllers\FrontProfilesController;
use App\Http\Controllers\PrivacypolicyController;
use App\Http\Controllers\TrainerInClubController;
use App\Http\Controllers\TrainingPlaceController;
use App\Http\Controllers\AtletInClubOwnController;
use App\Http\Controllers\AtletNeedVerifController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\JugdeInClubOwnController;
use App\Http\Controllers\RolePermissionController;
use App\Http\Controllers\StatusTrainnerController;
use App\Http\Controllers\SupportTrainnerController;
use App\Http\Controllers\TrainerInClubOwnController;
use App\Http\Controllers\CalendarActivitieController;
use App\Http\Controllers\TeamSupportsSportController;
use App\Http\Controllers\AtletInSportBranchController;
use App\Http\Controllers\FrontMatchScheduleController;
use App\Http\Controllers\SettingLandingPageController;
use App\Http\Controllers\SettingJugdeRefereeController;
use App\Http\Controllers\CertificateProfessionController;
use App\Http\Controllers\SettingJugdeRefereeLicenceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontendHomeController::class, 'index']);
Route::get('sports', [FrontSportsController::class, 'index'])->name('sports');
Route::get('sports/detail/{slug}', [FrontSportsController::class, 'detail']);
Route::get('profiles', [FrontProfilesController::class, 'index'])->name('profiles');

Route::get('news', [FrontNewsController::class, 'index'])->name('news');
Route::get('news/detail/{slug}', [FrontNewsController::class, 'detail']);
Route::get('news/category/{slug}', [FrontNewsController::class, 'detailCategory'])->name('news.category');
Route::get('news/hashtags/{slug}', [FrontNewsController::class, 'hashtags'])->name('news-hashtags');

Route::get('gallery', [FrontGalleryController::class, 'index'])->name('gallery');
Route::get('match-schedule', [FrontMatchScheduleController::class, 'index'])->name('match-schedule');
Route::get('match-schedule/{filename}', [FrontMatchScheduleController::class, 'download'])->name('match-schedule.download');

Route::get('privacy-policy', [PrivacypolicyController::class, 'listData'])->name('privacy-policy');

//Login Route
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('tologin', [LoginController::class, 'login'])->name('tologin');

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::group(['middleware' => 'auth'], function () {

    Route::get('logout', [LoginController::class, 'logout'])->name('logout');

    Route::group(['middlleware' => ['permission:dashboard']], function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::group(['middleware' => ['permission:sportbranch-list|sportbranch-create|sportbranch-edit|sportbranch-show|sportbranch-delete']], function () {
        Route::get('sport-branch/{sport_branch}/profile', [SportController::class, 'showProfile'])->name('sport-branch.profile');
        Route::get('sport-branch/{sport_branch}/profile/edit', [SportController::class, 'editProfile'])->name('sport-branch.profile.edit');
        Route::put('sport-branch/{sport_branch}/profile/update', [SportController::class, 'updateProfile'])->name('sport-branch.profile.update');
        
        Route::scopeBindings()->group( function() {
            Route::resource('sport-branch.team-support', TeamSupportsSportController::class);
        });
        
        Route::scopeBindings()->group( function() {
            Route::resource('sport-branch.role-permission', RoleSportController::class);
        });

        Route::scopeBindings()->group( function() {
            Route::resource('sport-branch.nomor', NomorController::class);
        });

        Route::group(['middleware' => ['permission:trainer-list|trainer-create|trainer-edit|trainer-show|trainer-delete']], function () {
            Route::scopeBindings()->group( function() {
                Route::resource('sport-branch.trainer', TrainnerController::class);
            });
        });

        Route::group(['middleware' => ['permission:judge-list|judge-create|judge-edit|judge-show|judge-delete']], function () {
            Route::scopeBindings()->group( function() {
                Route::resource('sport-branch.judge', JudgeController::class);
            });
        });

        Route::group(['middleware' => ['permission:atlet-list|atlet-create|atlet-edit|atlet-show|atlet-delete']], function () {
            Route::scopeBindings()->group( function() {
                Route::resource('sport-branch.atlet', AtletInSportBranchController::class);
            });
        });
        
        Route::group(['middleware' => ['permission:club-list|club-create|club-edit|club-show|club-delete']], function () {
            Route::group(['middleware' => ['permission:atlet-list|atlet-create|atlet-edit|atlet-show|atlet-delete']], function () {
                Route::scopeBindings()->group(function () {
                    Route::resource('sport-branch.clubs.atlet', AtletinClubController::class);
                });
            });
            Route::group(['middleware' => ['permission:trainer-list|trainer-create|trainer-edit|trainer-show|trainer-delete']], function () {
               
                Route::scopeBindings()->group( function() {
                    Route::resource('sport-branch.clubs.trainer', TrainerInClubController::class);
                });
            });
            Route::group(['middleware' => ['permission:judge-list|judge-create|judge-edit|judge-show|judge-delete']], function () {
                Route::scopeBindings()->group( function() {
                    Route::resource('sport-branch.clubs.judge', JudgeInClubController::class);
                });
            });
            Route::scopeBindings()->group( function() {
                Route::resource('sport-branch.clubs', ClubController::class);
            });
        });
        
        Route::group(['middleware' => ['role:superadmin|adminutama|koni']], function () {
            Route::resource('sport-branch', SportController::class); # Sport branch Route
        });
    });

    Route::group(['middleware' => ['role:club']], function () {
        
        Route::get('club/{club}/profile', [ClubController::class, 'showProfile'])->name('club.profile');
        Route::get('club/{club}/profile/edit', [ClubController::class, 'editProfile'])->name('club.profile.edit');
        Route::put('club/{club}/profile/update', [ClubController::class, 'updateProfile'])->name('club.profile.update');

        Route::group(['middleware' => ['permission:atlet-list|atlet-create|atlet-edit|atlet-show|atlet-delete']], function () {
            Route::scopeBindings()->group( function() {
                Route::resource('club.atlet', AtletInClubOwnController::class);
            });
        });

        Route::group(['middleware' => ['permission:trainer-list|trainer-create|trainer-edit|trainer-show|trainer-delete']], function () {
            Route::scopeBindings()->group( function() {
                Route::resource('club.trainer', TrainerInClubOwnController::class);
            });
        });

        Route::group(['middleware' => ['permission:judge-list|judge-create|judge-edit|judge-show|judge-delete']], function () {
            Route::scopeBindings()->group( function() {
                Route::resource('club.judge', JugdeInClubOwnController::class);
            });
        });
    });

    Route::group(['middleware' => ['permission:news-topnews-list|news-newsscheduled-list|news-expirednews-list|news-requestnews-list']], function () {
        // Route::post('tidings/{id}/requpdate', [NewsController::class, 'requestUpdate']); # Custom News create Route
        Route::get('tidings/{option}/notif', [NewsController::class, 'countData'])->name('tindings.notif');
        Route::get('tidings/{option}/create', [NewsController::class, 'create']); # Custom News create Route
        Route::get('tidings/{tidings}/edit/{option}', [NewsController::class, 'edit']); # Custom News edit Route
        Route::resource('tidings', NewsController::class); # News Route
        Route::resource('tidings-request', NewsRequestController::class);
        Route::resource('tidings-category', CategoryNewsController::class); # Category News Route
    });

    Route::group(['middleware' => ['permission:gallery-list|gallery-create']], function () {
        Route::resource('photo-gallery', GalleryController::class)->only(['index', 'store', 'destroy']); # Admin Galley Route
        Route::resource('club.photo-gallery', ClubGalleryController::class)->only(['index', 'store', 'destroy']); # Admin Galley Route
        Route::resource('sport-branch.photo-gallery', SportGalleryController::class)->only(['index', 'store', 'destroy']); # Admin Galley Route
    });

    Route::group(['middleware' => ['permission:calendar-list|calendar-create|calendar-edit|calendar-show|calendar-delete']], function () {
        Route::get('calendar-activitie/state/{state_id}', [CalendarActivitieController::class, 'getCityFromState'])->name('calendar-activitie.state'); # Calendar GET citie from state Route
        Route::get('calendar-activitie/countrie/{countrie_id}', [CalendarActivitieController::class, 'getStateFromCountrie'])->name('calendar-activitie.countrie'); # Calendar GET state from countrie Route
        Route::resource('calendar-activitie', CalendarActivitieController::class); # Calendar Route
    });

    Route::group(['middleware' => ['permission:admin-list|admin-create|admin-edit|admin-show|admin-delete']], function () {
        Route::resource('admin', AdminController::class); # Admin Route
        Route::resource('employ', EmployController::class); # Employ Route
        Route::resource('settings', SettingController::class)->only(['index', 'store']); # Settings Route
    });

    Route::group(['middleware' => ['permission:rolepermisson-list|rolepermisson-create|rolepermisson-edit|rolepermisson-show|rolepermisson-delete']], function () {
        Route::resource('rolepermission', RolePermissionController::class); # Role Permission Route
    });

    Route::group(['middleware' => ['permission:landing-page-setting-list|landing-page-setting-create']], function () {
        Route::resource('set-landing-page', SettingLandingPageController::class)->only(['index', 'store']); # Setting Landing Page Place Route
    });

    Route::group(['middleware' => ['permission:privacy-policy-setting-list|privacy-policy-setting-create']], function () {
        Route::resource('set-privacy-policy', PrivacypolicyController::class)->only(['index', 'store']); # Privacy Policy Place Route
    });

    Route::group(['middleware' => ['permission:trainer-setting-list|trainer-setting-create|trainer-setting-edit|trainer-setting-show|trainer-setting-delete']], function () {
        Route::resource('training-place', TrainingPlaceController::class); # Training Place Route
        Route::resource('setting-status-trainner', StatusTrainnerController::class); # Status Trainner Route
        Route::resource('setting-certificate-trainner', CertificateProfessionController::class); # Certificate Trainner Route
        Route::resource('setting-support-trainner', SupportTrainnerController::class); # Support Trainner Route
    });

    Route::group(['middleware' => ['permission:referee-judge-setting-list|referee-judge-setting-create|referee-judge-setting-edit|referee-judge-setting-show|referee-judge-setting-delete']], function () {
        Route::resource('setting-jugde-referee', SettingJugdeRefereeController::class); # Judge & referee Trainner Route
        Route::resource('setting-jugde-referee-licence', SettingJugdeRefereeLicenceController::class); # Judge & referee licence Trainner Route
    });

    Route::group(['middleware' => ['permission:atlet-need-verification-list|atlet-need-verification-edit']], function () {
        Route::resource('atlet-need-verif', AtletNeedVerifController::class)->only(['index', 'edit', 'update']); # Atlet Need Verif Route ~ unless
    });

    Route::group(['middleware' => ['permission:atlet-verify-list|atlet-verify-create|atlet-verify-edit|atlet-verify-show|atlet-verify-delete']], function () {
        Route::resource('atlet', AtletController::class); # Atlet Verify Route ~ unless
    });

    Route::group(['middleware' => ['permission:referee-list|referee-create|referee-edit|referee-show|referee-delete']], function () {
        Route::resource('referee', RefereeController::class); # Referee Route ~ unless
    });

    Route::group(['middleware' => ['permission:judge-list|judge-create|judge-edit|judge-show|judge-delete']], function () {
        Route::resource('judge', JudgeController::class); # Judge Route ~ unless
    });
});

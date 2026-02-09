<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicArticleController;
use App\Http\Controllers\PublicCourseController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EnrollmentController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| الموقع العام
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('public.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('public.contact');

Route::get('/courses', [PublicCourseController::class, 'index'])->name('public.courses');
Route::get('/courses/{course}', [PublicCourseController::class, 'show'])->name('public.courses.show');

Route::get('/articles', [PublicArticleController::class, 'index'])->name('public.articles');
Route::get('/articles/{article:slug}', [PublicArticleController::class, 'show'])->name('public.articles.show');

Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

/*
|--------------------------------------------------------------------------
| تسجيل الدخول
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| لوحة التحكم
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // الدورات
    Route::resource('courses', CourseController::class);

    // الطلاب
    Route::resource('students', StudentController::class);

    // التسجيلات
    Route::resource('enrollments', EnrollmentController::class);
    Route::post('enrollments/{enrollment}/complete', [EnrollmentController::class, 'complete'])->name('enrollments.complete');

    // الشهادات
    Route::resource('certificates', CertificateController::class)->except(['edit', 'update']);
    Route::get('certificates/{certificate}/print', [CertificateController::class, 'print'])->name('certificates.print');

    // المقالات
    Route::resource('articles', ArticleController::class)->except(['show']);

    // التقارير
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');

    //CONTACTS
    Route::get('contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::delete('contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
    Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
});

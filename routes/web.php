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
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\StudentController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryPageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Language Switcher
|--------------------------------------------------------------------------
*/
Route::get('/locale/{locale}', function (string $locale) {
    if (in_array($locale, ['ar', 'en'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('locale.switch');

/*
|--------------------------------------------------------------------------
| Public Website
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

Route::get('/gallery', [GalleryPageController::class, 'index'])->name('public.gallery');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Admin Panel - Staff Access (Admin + Receptionist)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'staff'])->group(function () {
    // Dashboard - accessible by all staff
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Courses - Receptionist can view only, Admin has full CRUD
    Route::get('courses', [CourseController::class, 'index'])->name('courses.index');

    // Course full CRUD (create, edit, delete) - Admin only
    // NOTE: These must be before courses/{course} to avoid the wildcard catching "create"
    Route::middleware('admin')->group(function () {
        Route::get('courses/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('courses', [CourseController::class, 'store'])->name('courses.store');
        Route::get('courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::put('courses/{course}', [CourseController::class, 'update'])->name('courses.update');
        Route::delete('courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
    });

    Route::get('courses/{course}', [CourseController::class, 'show'])->name('courses.show');

    // Students - Receptionist can create/view, Admin has full CRUD
    Route::get('students', [StudentController::class, 'index'])->name('students.index');
    Route::get('students/create', [StudentController::class, 'create'])->name('students.create');
    Route::post('students', [StudentController::class, 'store'])->name('students.store');
    Route::get('students/{student}', [StudentController::class, 'show'])->name('students.show');

    // Enrollments - Receptionist can create/view, Admin has full CRUD
    Route::get('enrollments', [EnrollmentController::class, 'index'])->name('enrollments.index');
    Route::get('enrollments/create', [EnrollmentController::class, 'create'])->name('enrollments.create');
    Route::post('enrollments', [EnrollmentController::class, 'store'])->name('enrollments.store');

    // Certificates - Receptionist can view/print, Admin has full CRUD
    Route::get('certificates', [CertificateController::class, 'index'])->name('certificates.index');
    Route::get('certificates/create', [CertificateController::class, 'create'])->name('certificates.create')->middleware('admin');
    Route::post('certificates', [CertificateController::class, 'store'])->name('certificates.store')->middleware('admin');
    Route::delete('certificates/{certificate}', [CertificateController::class, 'destroy'])->name('certificates.destroy')->middleware('admin');
    Route::get('certificates/{certificate}', [CertificateController::class, 'show'])->name('certificates.show');
    Route::get('certificates/{certificate}/print', [CertificateController::class, 'print'])->name('certificates.print');

    // Contacts/Messages - Receptionist can view, Admin can delete
    Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
    Route::get('contacts/{contact}', [ContactController::class, 'show'])->name('contacts.show');

    /*
    |--------------------------------------------------------------------------
    | Admin Only Routes
    |--------------------------------------------------------------------------
    */
    Route::middleware('admin')->group(function () {
        // Student edit/delete
        Route::get('students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
        Route::put('students/{student}', [StudentController::class, 'update'])->name('students.update');
        Route::delete('students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');

        // Enrollment edit/delete/complete
        Route::get('enrollments/{enrollment}', [EnrollmentController::class, 'show'])->name('enrollments.show');
        Route::get('enrollments/{enrollment}/edit', [EnrollmentController::class, 'edit'])->name('enrollments.edit');
        Route::put('enrollments/{enrollment}', [EnrollmentController::class, 'update'])->name('enrollments.update');
        Route::delete('enrollments/{enrollment}', [EnrollmentController::class, 'destroy'])->name('enrollments.destroy');
        Route::post('enrollments/{enrollment}/complete', [EnrollmentController::class, 'complete'])->name('enrollments.complete');

        // Articles - Admin only
        Route::resource('articles', ArticleController::class)->except(['show']);

        // Gallery - Admin only
        Route::get('gallery', [GalleryController::class, 'index'])->name('gallery.index');
        Route::get('gallery/categories/create', [GalleryController::class, 'createCategory'])->name('gallery.categories.create');
        Route::post('gallery/categories', [GalleryController::class, 'storeCategory'])->name('gallery.categories.store');
        Route::get('gallery/categories/{category}/edit', [GalleryController::class, 'editCategory'])->name('gallery.categories.edit');
        Route::put('gallery/categories/{category}', [GalleryController::class, 'updateCategory'])->name('gallery.categories.update');
        Route::delete('gallery/categories/{category}', [GalleryController::class, 'destroyCategory'])->name('gallery.categories.destroy');
        Route::get('gallery/images/create', [GalleryController::class, 'createImage'])->name('gallery.images.create');
        Route::post('gallery/images', [GalleryController::class, 'storeImage'])->name('gallery.images.store');
        Route::get('gallery/images/{image}/edit', [GalleryController::class, 'editImage'])->name('gallery.images.edit');
        Route::put('gallery/images/{image}', [GalleryController::class, 'updateImage'])->name('gallery.images.update');
        Route::delete('gallery/images/{image}', [GalleryController::class, 'destroyImage'])->name('gallery.images.destroy');
        Route::post('gallery/images/update-order', [GalleryController::class, 'updateOrder'])->name('gallery.images.updateOrder');

        // Reports - Admin only
        Route::get('reports', [ReportController::class, 'index'])->name('reports.index');

        // Contact delete - Admin only
        Route::delete('contacts/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');

        // User management - Admin only
        Route::get('users', [UserController::class, 'index'])->name('users.index');
        Route::get('users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('users', [UserController::class, 'store'])->name('users.store');
        Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });

    // Profile edit - any authenticated staff
    Route::get('profile', [UserController::class, 'profile'])->name('profile.edit');
    Route::put('profile', [UserController::class, 'updateProfile'])->name('profile.update');
});

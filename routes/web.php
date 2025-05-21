<?php
namespace App\Http\Controllers;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GalleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Models\Event;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\NewsletterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Home route with schedules redirect
Route::get('/', function () {
    if (request()->getRequestUri() === '/#schedules') {
        return redirect('/schedules');
    }
    return app(HomeController::class)->home();
})->name('home');

// Public Event Routes
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/featured', [EventController::class, 'featured'])->name('events.featured');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');
Route::get('/schedules', [EventController::class, 'schedules'])->name('events.schedules');

// Protected Event Routes (require authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');
    Route::get('/events/{event}/book', [EventController::class, 'book'])->name('events.book');
    Route::post('/events/{event}/book', [EventController::class, 'storeBooking'])->name('events.book.store');
    Route::get('/events/{event}/register', [EventController::class, 'register'])->name('events.register');
    
    // Booking routes
    Route::get('/bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
});

// Organizer routes
Route::get('/organizer/register', [OrganizerController::class, 'register'])->name('organizer.register');
Route::post('/organizer/register', [OrganizerController::class, 'store'])->name('organizer.store');
Route::get('/organizer/dashboard', [OrganizerController::class, 'dashboard'])->name('organizer.dashboard');
Route::get('/organizer/{organizer}', [OrganizerController::class, 'profile'])->name('organizer.profile');
Route::get('/organizers', [OrganizerController::class, 'index'])->name('organizers.index');

// Blog routes
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

// Gallery routes
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

// Features page
Route::get('/features', [HomeController::class, 'features'])->name('features');

// Plans routes
Route::get('/plans/professional', [HomeController::class, 'professionalPlan'])->name('plans.professional');
Route::get('/plans/enterprise', [HomeController::class, 'enterprisePlan'])->name('plans.enterprise');

// Authentication routes
Route::middleware('guest')->group(function () {
    // Support both /signin and /login for backward compatibility
    Route::get('/signin', [UserController::class, 'showLoginForm'])->name('signin');
    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserController::class, 'login']);
    
    // Registration routes
    Route::get('/signup', [UserController::class, 'showRegistrationForm'])->name('register');
    Route::post('/signup', [UserController::class, 'register']);
    Route::post('/register', [UserController::class, 'register']);
    Route::get('/password/reset', [UserController::class, 'showResetForm'])->name('password.request');
    Route::post('/password/email', [UserController::class, 'sendResetLink'])->name('password.email');
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::post('/logout', [UserController::class, 'logout']);
});

// Contact routes
Route::get('/contact', [ContactController::class, 'showForm'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'sendMessage'])->name('contact.send');

// Newsletter route
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('home');
    Route::resource('events', AdminEventController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('users', AdminUserController::class);
    Route::resource('blog', AdminBlogController::class);
    Route::patch('events/{event}/publish', [AdminEventController::class, 'publish'])->name('events.publish');
    Route::patch('events/{event}/deactivate', [AdminEventController::class, 'deactivate'])->name('events.deactivate');
    Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
    Route::patch('/bookings/{booking}/confirm', [BookingController::class, 'confirm'])->name('bookings.confirm');
    Route::patch('/bookings/{booking}/mark-paid', [BookingController::class, 'markPaid'])->name('bookings.mark-paid');
    Route::get('/bookings/{booking}/receipt', [BookingController::class, 'receipt'])->name('bookings.receipt');
    Route::get('/bookings/export', [BookingController::class, 'export'])->name('bookings.export');
});

Route::get('/event/index', function () {
    $events = Event::all(); // Charger tous les événements
    return view('admin.events.index', compact('events'));
})->name('event.index');
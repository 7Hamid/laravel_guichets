<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\programmableTicketController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\ProfileController;


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

Route::get('/about', function () {
    return view('about');
});
Route::middleware('auth')->group(function () {
    Route::resource('tickets', TicketController::class);
});

Route::get('/contact', function () {
    return view('contact');
});
Route::post('/contact-submit', [ContactController::class, 'submit'])->name('contact.submit');
Route::get('/', [TicketController::class, 'showTickets'])->name('tickets.showTickets');
Route::get('/contact', [ContactController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::resource('categories', CategoryController::class);
Route::get('/closedTickets', [TicketController::class, 'closedTickets'])->name('tickets.closedTickets');
Route::get('/category/{category}', [TicketController::class, 'filterByCategory'])->name('tickets.filter');
//Route::resource('programmableTickets', ProgrammableTicketController::class);


// Auth routes (provided by Laravel Breeze or Fortify, or you can define them manually)
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Logout route
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Profile route (for logged-in users only)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});


// Route for displaying the index of tickets
Route::get('/programmableTickets', [ProgrammableTicketController::class, 'index'])->name('programmableTickets.index');

// Route for showing the form to create a new ticket
Route::get('/programmableTickets/create', [ProgrammableTicketController::class, 'create'])->name('programmableTickets.create');


// Route for storing a new ticket
Route::post('/programmableTickets', [ProgrammableTicketController::class, 'store'])->name('programmableTickets.store');

// Route for showing the details of a specific ticket
Route::get('/programmableTickets/{id}', [ProgrammableTicketController::class, 'show'])->name('programmableTickets.show');

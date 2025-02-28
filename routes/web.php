<?php

use Laravel\Pail\Files;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FormTicketController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\FormTicketExportController;
use App\Http\Controllers\Notification\NotificationController;

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\User\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/list', [App\Http\Controllers\User\DashboardController::class, 'showList'])->name('dashboard/list');
    Route::get('/dashboard/Guest/create', [App\Http\Controllers\User\DashboardController::class, 'create'])->name('dashboard.guest.create');
    Route::get('/dashboard/Guest/{FormTicket}/edit', [App\Http\Controllers\User\DashboardController::class, 'edit'])->name('dashboard.guest.edit');
    Route::put('/dashboard/Guest/{FormTicket}/Update', [App\Http\Controllers\User\DashboardController::class, 'Update'])->name('dashboard.guest.Update');
    Route::delete('/dashboard/guest/{user}', [App\Http\Controllers\User\DashboardController::class, 'destroy'])->name('dashboard.guest.destroy');


    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index'); // View notifications
    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead'); // Mark as read
    Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

Route::get('/notifications/count', function () {
    return response()->json(['count' => auth()->user()->unreadNotifications->count()]);
})->name('notifications.count');
});








route::resource('/Guest' ,FormTicketController::class);

Route::get('/thanks', [FormTicketController::class, 'thanks'])->name('thanks');
Route::get('/export-pdf', [FormTicketController::class, 'exportPDF'])->name('export.pdf');
Route::get('/export-csv', [FormTicketController::class, 'exportCsv'])->name('export.csv');
route::resource("admin" , AdminController::class);
Route::get('/export/new-pdf', [FormTicketController::class, 'generateFormTicketsPDF'])->name('export.new_pdf');
Route::get('/export/new-csv', [FormTicketController::class, 'generateFormTicketsCSV'])->name('export.new_csv');


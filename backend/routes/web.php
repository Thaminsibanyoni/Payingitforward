
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\KindnessController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\PointController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserDashboardController;
use App\Models\Donation;

Route::get('/donate', [DonationController::class, 'show'])->name('donate');

Route::get('/', function () {
$donations = Donation::latest()->take(5)->get();
$stories = \App\Models\KindnessStory::where('status', 'approved')
->latest()
->take(6)
->get();
return view('home', compact('donations', 'stories'));
})->name('home');

Route::get('/about', function () {
return view('about');
})->name('about');

Route::get('/community', [CommunityController::class, 'show'])->name('community');
Route::get('/kindness', [KindnessController::class, 'index'])->name('kindness');
Route::get('/kindness/{story}', [KindnessController::class, 'show'])->name('kindness.show');
Route::post('/kindness/submit', [KindnessController::class, 'submit'])->name('kindness.submit');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/password/reset', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'reset'])->name('password.update');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::get('/user/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard');

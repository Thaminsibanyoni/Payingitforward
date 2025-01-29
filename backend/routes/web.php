use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\AdminController;

// Public routes
Route::prefix('payments')->group(function () {
    Route::post('/paypal/callback', [PaymentController::class, 'handlePayPalCallback']);
    Route::post('/binance/create', [PaymentController::class, 'createBinanceOrder']);
});

// Admin routes
Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
    Route::apiResource('/users', AdminController::class)->only(['index', 'show', 'update']);
    Route::post('/kyc/approve/{kycSubmission}', [AdminController::class, 'approveKyc']);
    Route::get('/transactions', [AdminController::class, 'getTransactions']);
});

// Root route
Route::get('/', function () {
    return response()->json([
        'message' => 'Welcome to the PayingItForward Platform API',
        'status' => 'success'
    ]);
});

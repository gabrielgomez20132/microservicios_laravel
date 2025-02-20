<?php


use MongoDB\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */
Route::prefix('v1')->middleware(['api','jwt.verify'])->group(function(){
    Route::prefix('products')->group(function(){
        Route::get('/', [ProductController::class, 'index']);
        Route::post('/', [ProductController::class, 'store']);
        Route::get('/{id}', [ProductController::class, 'show']);
        Route::put('/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
        Route::get('/search/searchByName', [ProductController::class, 'searchByName']);

        Route::post('logout', [AuthController::class, 'logout']);
        Route::post('refresh', [AuthController::class, 'refresh']);
        Route::get('me', [AuthController::class, 'me']);
    });
});

/* Route::get('test',function(){
    try {
        $client = new Client(ENV('MONGO_URI'));

        $collection = $client->inventory->products;
        $newProductResult = $collection->insertOne(['name' => 'Pizza', 'Ingredients' => ['queso','masa','tomate'] ]);

        return response()->json([
            'message' => 'guardado con exito',
            'producto' => $newProductResult
        ]);

    } catch (Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
}); */
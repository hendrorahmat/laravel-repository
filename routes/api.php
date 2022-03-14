<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\V1\{
    TopicController,
    NewsController,
    TagController
};

Route::prefix('v1')->group(function () {
    Route::resource('topic', TopicController::class);
    Route::resource('news', NewsController::class);
    Route::resource('tags', TagController::class);
    Route::post('calculate-coupon', [\App\Http\Controllers\Api\V1\CalculateCouponController::class, 'store']);
});

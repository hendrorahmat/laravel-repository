<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\v1\{
    TopicController,
    NewsController,
    TagController
};

Route::prefix('v1')->group(function () {
    Route::resource('topic', TopicController::class);
    Route::resource('news', NewsController::class);
    Route::resource('tags', TagController::class);
});

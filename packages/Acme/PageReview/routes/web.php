<?php
// Single review view.
Route::get('pagereview', 'PageReviewController@index')
    ->name('pagereview.index');

// Store review action.
Route::post('pagereview', 'PageReviewController@store')
    ->name('pagereview.store');
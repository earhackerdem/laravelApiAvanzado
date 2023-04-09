<?php

namespace App\Providers;

use App\Http\Resources\RatingResource;
use App\Models\Rating;
use Illuminate\Contracts\View\View;
use Illuminate\Support\ServiceProvider;

//php artisan make:provider RatingServiceProvider
class RatingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer(
            'home',
            fn (View $view) =>
            $view->with(
                'ratings',
                RatingResource::collection(Rating::with('rateable','qualifier')->get())
            )
        );
    }
}

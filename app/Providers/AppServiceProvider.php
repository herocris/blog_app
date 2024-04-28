<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use App\Models\Post;
use DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    //agregar linea 34 a la version de produccion 
    public function boot()
    {
         DB::statement("SET lc_time_names='es_MX'");
        $archive = Post::selectRaw('year(published_at) as year')
        ->selectRaw('monthname(published_at) as monthname')
        ->selectRaw('month(published_at) as month')
        ->selectRaw('count(*) as posts')
        ->where([['category_id','!=',4], ['body', '!=', 'null'], ['excerpt', '!=', 'null'], ['visible', '!=',0]])
        ->orderBy('published_at')
        ->groupBy('year', 'month', 'monthname')->get();
        view()->share('archive', $archive);
        view()->share('categories', Category::all());
        
        if(config('app.env') === 'local') {
            \URL::forceScheme('https');
        } // en la linea 39 se modifico el parametro http para quitar rutas https

    }
}

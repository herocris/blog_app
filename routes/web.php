<?php

use App\Models\Post;
use App\Models\Report;
use App\Models\Tag;
use Illuminate\Support\Facades\Route;


/*Route::get('email', function () {
    return new App\Mail\CommentNotification(App\Models\Comments::first());
});*/
//RUTA PARA EL BUSCADOR EN TIEMPO REAL DE PRUEBA
Route::get('indexposts', 'PagesController@indexposts')->name('indexposts');

Route::get('/', 'PagesController@home')->name('pages.home');
Route::get('contact', 'PagesController@contact')->name('pages.contact');
Route::get('reports', 'PagesController@reports')->name('pages.reports');          //Cargar la pagina
Route::get('indexreports', 'PagesController@indexreports')->name('indexreports'); //Llenar la pagina
Route::get('blog/{id}', 'PostsController@show')->name('posts.show');
Route::get('categorias/{category}', 'CategoriesController@show')->name('categories.show');
//Route::get('categorias/{category}', 'CategoriesController@evento')->name('categories.evento');
Route::get('tags/{tag}', 'TagsController@show')->name('tags.show');
Route::post('comments', 'CommentsController@store')->name('comments.store');
Route::post('categories', 'CategoriesController@categories_save')->name('categories.categories_save');

Route::post('reports/hola', 'AjaxController@hola')->name('admin.reports.hola');
Route::put('reports/{report}', 'ReportsController@update')->name('reports.update');
//Route::put('categoriess/{id}', 'CategoriesController@updateCategoria')->name('categories.updateCategoria');

//paginas de administracion
Route::group(
    [
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'middleware' => 'auth'
    ],
    function () {

        Route::get('/', 'AdminController@index')->name('dashboard');
        Route::get('binaccle', 'BinnacleController@index')->name('admin.binnacle');
        Route::delete('photos/{photo}', 'PhotosController@destroy')->name('admin.photos.destroy');
        Route::get('photos2/{photo}', 'PhotosController@delete')->name('admin.photos.delete');
        Route::post('posts', 'PostsController@save')->name('admin.posts.save');
        Route::post('posts/{post}/photos', 'PhotosController@store')->name('admin.posts.photos.store');
        Route::post('posts/{post}', 'PostsController@disable')->name('admin.posts.disable');
        Route::post('users/{user}', 'UserController@disable')->name('admin.users.disable');
        Route::resource('posts', 'PostsController', ['except' => ['show','create'], 'as' => 'admin']);
        //ruta para el popup
        Route::get('indexm/{id}', 'PostsController@modal')->name('admin.index_modal');
        Route::resource('users', 'UserController', ['as' => 'admin']);
        Route::resource('roles', 'RolesController', ['except' => 'show','as' => 'admin']);
        Route::resource('permissions', 'PermissionsController', ['except' => 'show','as' => 'admin']);
        Route::resource('comments', 'CommentsController', ['only' => ['index','destroy'],'as' => 'admin']);
        Route::resource('reports', 'ReportsController', ['except' => ['show'],'as' => 'admin']);
        // Route::resource('tags', 'TagsController', ['except' => ['show'],'as' => 'admin']);
        Route::get('tags', 'TagsController@index')->name('admin.tags.index');
        Route::get('tags/create', 'TagsController@create')->name('admin.tags.create');
        Route::post('tags/store', 'TagsController@store')->name('admin.tags.store');
        Route::get('tags/edit/{tag}', 'TagsController@edit')->name('admin.tags.edit');
        Route::put('tags/update/{tag}', 'TagsController@update')->name('admin.tags.update');
        Route::put('tags/update/{tag}', 'TagsController@update')->name('admin.tags.update');
        Route::post('tags/{tag}', 'TagsController@disable')->name('admin.tags.disable');
        
        

        /*Route::get('posts', 'PostsController@index')->name('admin.posts.index');
        Route::get('posts/create', 'PostsController@create')->name('admin.posts.create');
        Route::post('posts', 'PostsController@store')->name('admin.posts.store');
        Route::get('posts/{post}', 'PostsController@edit')->name('admin.posts.edit');
        Route::put('posts/{post}', 'PostsController@update')->name('admin.posts.update');
        Route::put('post/{post}', 'PostsController@destroy')->name('admin.posts.destroy');*/

        //Permision Update (Edit)
        Route::middleware('role:Admin')
        ->put('users/{user}/roles', 'UserRolesController@update')
        ->name('admin.users.roles.update');

        //Permision Role Admin
        Route::middleware('role:Admin')
        ->put('users/{user}/roles', 'UserRolesController@update')
        ->name('admin.users.roles.update');

        Route::put('users/{user}/permissions', 'UserPermissionsController@update')->name('admin.users.permissions.update');

        //Permision Update (edit categoria)
        Route::middleware('role:Admin')
        ->put('users/{user}/categories', 'UserCategoriesController@update')
        ->name('admin.users.categories.update');

        //Report Update (edit report)
        
    }
);



/*ruta hacia el panel de administracion
Route::get('/home', function () {
return view('admin.dashboard');
})->middleware('auth');*/

Auth::routes();
//Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('home');

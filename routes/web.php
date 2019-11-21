<?php
use Illuminate\Support\Facades\Artisan;
use GuzzleHttp\Psr7\Request;

Route::get('/', function(){
   return view('home.index')->with('cmd','index');
});

Route::get('/item/tag/{tag}', function($tag){
   $tag=str_replace('-',' ',$tag);
   $tags=DB::table('blogs')->where('title','LIKE','%'.$tag.'%')->orWhere('description','LIKE','%'.$tag.'%')->get();
   return view('home.index')->with('blogs',$tags)->with('cmd','tags')->with('tag',$tag);   
});

Route::get('/item/{id}/{slug}', function($id){
   $blog=DB::table('blogs')->where('id', $id)->where('status','1')->first();
   return view('home.index')->with('blog',$blog)->with('cmd','item');   
});
Route::get('/all/{id}/{slug}', function($id){
   $blogs=DB::table('blogs')->where('cid', $id)->where('status','1')->orderBy('id','desc')->get();
   return view('home.index')->with('blogs',$blogs)->with('cmd','group')->with('groupID',$id);   
});

Route::get('/page/{slug}', function($slug){
   //dd('ok');
   $page=DB::table('pages')->where('slug',$slug)->where('status','1')->first();
   return view('home.index')->with('page',$page)->with('cmd','page');   
});

Route::get('/home', 'HomeController@index')->name('home');
Auth::routes([
   'register' => true,
   'reset' => false,
   'verify' => false,
]);

//Route for normal user ( middleware/Authencate.php )
Route::group(['middleware' => ['auth']], function () {
   Route::get('/home', 'HomeController@index');
});
//Route for admin
Route::group(['prefix' => 'admin'], function(){
   Route::group(['middleware' => ['admin']], function(){
      Route::get('/test', function(){
         return view('layouts.admin-theme');
      });
      Route::get('/', 'Admin\AdminController@index');
      Route::resource('/setup', 'Admin\SetupController');
      Route::resource('/user', 'Admin\UserController');
      Route::resource('/group', 'Admin\GroupController');
      Route::resource('/blog', 'Admin\BlogController');
      Route::resource('/review', 'Admin\ReviewController');
      Route::resource('/result', 'Admin\ResultController');
      Route::resource('/league', 'Admin\LeagueController');
      Route::resource('/page', 'Admin\PageController');
      Route::resource('/menu', 'Admin\MenuController');
   });
});
Route::get('ckeditor', 'CkeditorController@index');
Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload');


Route::get('cc', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
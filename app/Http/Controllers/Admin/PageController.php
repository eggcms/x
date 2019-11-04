<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Page;
use DB;
class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(request $request)
   {
      $keyword = $request->get('search');
      $perPage = 15;
      if (!empty($keyword)) {
         $pages = Page::where('title', 'LIKE', "%$keyword%")->orWhere('description', 'LIKE', "%$keyword%")
         ->latest()->paginate($perPage);
      } else {
         $pages = Page::latest()->paginate($perPage);
      }
      return view('admin.page.index')->with('pages',$pages)->with('cmd','index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


   $b_exists = DB::table('pages')->where('title', $request->input('title'))->exists();
   if($b_exists) {
      return redirect()->back()->withInput()->with('error', 'Error! Page Title has data already exists.');
   }

   $validatedData = $request->validate([
      'title' => 'required',
      'description' => 'required',
      'content' => 'required',
   ]);

   $tag = $request->input('tag');
   if ($tag == '') $tag = '';
   $pages = new Page;
   $pages->uid = \Auth::user()->id;
   $pages->pid = 0;
   $pages->title = $request->input('title');
   $pages->description = $request->input('description');
   $pages->content = $request->input('content');
   $pages->tag = $tag;
   if ($pages->slug != Str::slug($pages->title)) $pages->slug = Str::slug($pages->title);
   $pages->status = ($request->input('status') == true) ? '1':'0';       
   $pages->created_at = date('Y-m-d H:i:s');
   $pages->updated_at = date('Y-m-d H:i:s');
   $pages->visit = ($pages->visit == '')?0:$pages->visit;

   $pages->save();
   return redirect('/admin/page')->with('success','Success! New Page has been Created.');

   }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function edit($id)
   {
      $page = Page::find($id);
      return view('admin.page.index')->with('page', $page)->with('cmd','edit');
   }

   public function change($switch, $id) {
      $pages = Page::find($id);
      if ($switch == 'status') {
          $pages->status = ($pages->status != 1) ? '1':'0';
      }
      $pages->save();
      return redirect('admin/page')->with('success', ' Success! Page ID: '.$id.' has been Updated.');
   }


   public function update(Request $request, $id)
   {
      //dd($request->switch1);
      if ($request->switch) {
         return $this->change($request->switch,$id);
      }
      $validatedData = $request->validate([        
         'title' => 'required',
         'description' => 'required',
         'content' => 'required',
      ]);
        
      $tag = $request->input('tag');
      if ($tag == '') $tag = '';
      $pages = Page::find($id);
      $pages->uid = $pages->uid;
      $pages->pid = 0;
      $pages->title = $request->input('title');
      $pages->description = $request->input('description');
      $pages->content = $request->input('content');
      $pages->tag = $tag;
      $pages->status = ($request->input('status') == 1) ? 1:0;
      $pages->created_at = $pages->created_at;
      $pages->updated_at = date('Y-m-d H:i:s');        
      $pages->visit = ($pages->visit == '')?0:$pages->visit;
      if ($pages->slug != Str::slug($pages->title)) $pages->slug = Str::slug($pages->title);
      $pages->save();
      return redirect()->back()->with('success', ' Success! Page ID: '.$id.' has been Updated.');

   }


   public function destroy($id)
   {
      $page = Page::find($id);
      $page->delete();
      return redirect()->back()->with('success', 'Page ID:'.$id.' has been Removed.');  
   }
}

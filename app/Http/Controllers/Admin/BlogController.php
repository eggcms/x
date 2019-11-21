<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Blog;
use Image;
use DB;
use Auth;

class BlogController extends Controller
{
   public function index(request $request)
   {
      $keyword = $request->get('search');
      $perPage = 15;
      if (!empty($keyword)) {
          $blogs = Blog::where('title', 'LIKE', "%$keyword%")->orWhere('description', 'LIKE', "%$keyword%")
            ->latest()->paginate($perPage);
      } else {
          $blogs = Blog::latest()->paginate($perPage);
      }
      return view('admin.blog.index')->with('blogs', $blogs)->with('cmd', 'index');
   }


   public function create()
   {
      return view('admin.blog.index')->with('cmd', 'create');
   }


    public function store(Request $request)
    {
        $b_exists = DB::table('blogs')->where('title', $request->input('title'))->exists();
        if($b_exists) {
            return redirect()->back()->withInput()->with('error', 'Error! Title has data already exists.');
        }
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'images' => 'image|nullable|max:2084',
        ]);
        if($request->hasFile('image')){
            $filanemaWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filanemaWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $cover_path  = str_replace('/','\\',public_path('storage/images/'));
            $request->file('image')->move('storage/images',$fileNameToStore);    
        //    $request->file('image')->storeAs('public/thumbs', $fileNameToStore);
        //    $thumbPath = str_replace('/','\\',public_path('storage/thumbs/'.$fileNameToStore));
        //    $this->createThumbnail($thumbPath, 300, null);
        }
        else { $fileNameToStore = 'noimg.jpg'; }

         $tag = $request->input('tag');
         if ($tag == '') $tag = '';
         $blogs = new Blog;
         $blogs->uid = \Auth::user()->id;
         $blogs->title = $request->input('title');
         $blogs->description = $request->input('description');
         $blogs->content = $request->input('content');
         $blogs->tag = $tag;
         if ($blogs->slug != Str::slug($blogs->title)) $blogs->slug = Str::slug($blogs->title);
         $blogs->status = ($request->input('status') == true) ? '1':'0';
         $blogs->hot = ($request->input('hot') == true) ? '1':'0';
         $blogs->switch1 = ($request->input('switch1') == true) ? '1':'0';            
         $blogs->published = date('Y-m-d H:i:s');
         $blogs->created_at = date('Y-m-d H:i:s');
         $blogs->updated_at = date('Y-m-d H:i:s');
         $blogs->uid = auth()->user()->id;
         $blogs->visit = ($blogs->visit == '')?0:$blogs->visit;
         $blogs->clip = ($request->input('clip')!=null) ? getYoutube($request->input('clip')):null;
         $blogs->cid = ($request->input('cid')!=null)?$request->input('cid'):'0';
         $blogs->image = $fileNameToStore;
         $blogs->save();
         return redirect('/admin/blog')->with('success','Success! New Blog has been Created.');

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
      $blog = Blog::find($id);
      return view('admin.blog.index')->with('blog', $blog)->with('cmd','edit');
    }

    public function change($switch, $id) {
      $blogs = Blog::find($id);
      if ($switch == 'status') {
          $blogs->status = ($blogs->status != 1) ? '1':'0';
      }
      if ($switch == 'hot') {
          $blogs->hot = ($blogs->hot != 1) ? '1':'0';
      }
      $blogs->save();
      return redirect('admin/blog')->with('success', ' Success! blog ID: '.$id.' has been Updated.');
    }



    public function update(Request $request, $id)
    {
//dd($request->image);
        if ($request->switch) {
            return $this->change($request->switch,$id);
        }

        $validatedData = $request->validate([        
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'image' => 'image|nullable|max:2084',
        ]);
     
        if($request->hasFile('image')){
            $filanemaWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filanemaWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;
            $cover_path  = str_replace('/','\\',public_path('storage/images/'));
        // $thumb_path  = str_replace('/','\\',public_path('storage/thumbs/'));
            $request->file('image')->move('storage/images',$fileNameToStore);    
        // $thumbPath = str_replace('/','\\',public_path('storage/thumbs/'.$fileNameToStore));
            $del_image = $cover_path.$request->old_image;
        // $del_thumb = $thumb_path.$request->old_image;
            if (file_exists($del_image)) {
                unlink($del_image);
            // if (file_exists($del_thumb)) unlink($del_thumb);
            }
        // $this->createThumbnail($thumbPath, 300, null);            
        }
        else $fileNameToStore = 'noimg.jpg';
        $tag = $request->input('tag');
        if ($tag == '') $tag = '';
        $blogs = Blog::find($id);

        $blogs->title = $request->input('title');
        $blogs->description = $request->input('description');
        $blogs->content = $request->input('content');
        $blogs->tag = $tag;
        $blogs->status = ($request->input('status') == 1) ? 1:0;
    //   $blogs->hot = ($request->input('hot') == null) ? '0':'1';
        $blogs->switch1 = ($request->input('switch1') == 1) ? 1:0;                
        if ($request->image) $blogs->image = $fileNameToStore;
        else $blogs->image = $request->old_image;
        $blogs->published = $blogs->published;
        $blogs->created_at = $blogs->created_at;
        $blogs->updated_at = date('Y-m-d H:i:s');        
        $blogs->uid = $blogs->uid;
        $blogs->visit = ($blogs->visit == '')?0:$blogs->visit;
        $blogs->clip = ($request->input('clip')!=null) ? getYoutube($request->input('clip')):$blogs->clip;
        $blogs->cid = ($request->input('cid')!=null)?$request->input('cid'):0;
        if ($blogs->slug != Str::slug($blogs->title)) $blogs->slug = Str::slug($blogs->title);
        $blogs->save();
        return redirect()->back()->with('success', ' Success! blog ID: '.$id.' has been Updated.');  
    }

   public function destroy($id)
   {
      $blog = Blog::find($id);
      $cover_path  = str_replace('/','\\',public_path('storage/images/'.$blog->image));
      if (file_exists($cover_path)) { unlink($cover_path); }
      $blog->delete();
      return redirect()->back()->with('success', 'Blogs ID:'.$id.' has been Removed.');  
   }

   public function createThumbnail($path, $width, $height)
   {
      $img = Image::make($path)->resize($width, $height, function ($constraint) {
         $constraint->aspectRatio();
      });
      $img->save($path);
   }        
}

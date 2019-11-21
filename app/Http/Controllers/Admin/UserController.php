<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use DB;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
   {
      $users=User::orderBy('level','desc')->get();
      return view('admin.user.index')->with('users', $users)->with('cmd','index');
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
      $user=User::find($id);
      return view('admin.user.index')->with('user', $user)->with('cmd','edit');
   }

  
   public function change($switch, $id) {
      $user = User::find($id);
      if ($switch == 'status') {
          $user->status = ($user->status != 1) ? '1':'0';
      }
      $user->save();
      return redirect('admin/user')->with('success', ' Success! user ID: '.$id.' has been Updated.');  
   }


   public function update(Request $request, $id)
   {
      //dd($request->switch);
      if (Auth::user()->level < 100) return redirect('admin/user')->with('error', ' Sory bro, cannot setup. Your rank are low'); 
      if ($request->switch!=null) {
         if ($request->switch) {
            return $this->change($request->switch,$id);
         }     
      }

      $validatedData = $request->validate([        
         'name' => 'required',
         'email' => 'required',
         'image' => 'image|nullable|max:2084',
     ]);
     
     // Handle File upload.
     if($request->hasFile('image')){
         $filanemaWithExt = $request->file('image')->getClientOriginalName();
         $filename = pathinfo($filanemaWithExt, PATHINFO_FILENAME);
         $extension = $request->file('image')->getClientOriginalExtension();
         $fileNameToStore = $filename.'_'.time().'.'.$extension;
         $cover_path  = str_replace('/','\\',public_path('storage/avatar/'));
         $request->file('image')->move('storage/avatar',$fileNameToStore);
         $del_image = $cover_path.$request->old_image;
         if (file_exists($del_image) && $request->old_image!=null) {
             unlink($del_image);
         }        
      }
      else $fileNameToStore = 'avatar_m3.png';
      $users = User::find($id);

      $users->name = $request->input('name');
      $users->nickname = $request->input('nickname');
      $users->level = $request->input('level');
      $users->facebook = $request->input('facebook');
      $users->line = $request->input('line');
      $users->status = ($request->input('status') == 1) ? 1:0;                

      if ($request->image) $users->image = $fileNameToStore;
      else $users->image = $request->old_image;

      $users->created_at = $users->created_at;
      $users->updated_at = date('Y-m-d H:i:s');        

      $users->save();
      return redirect()->back()->with('success', ' Success! User ID: '.$id.' has been Updated.');  
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

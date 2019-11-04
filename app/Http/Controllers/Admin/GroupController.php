<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Group;

class GroupController extends Controller
{
   function __construct() {
//      data('page_active','blog');
   }
   public function index(request $request)
   {
      //return url()->current();
      //return \Route::current()->getName();
      // if (isset($request)) $keyword = $request->get('search');
      // $perPage = 15;
      // if (!empty($keyword)) {
      //    $groups = Group::where('title', 'LIKE', "%$keyword%")->orWhere('description', 'LIKE', "%$keyword%")
      //       ->orderBy('orders','desc')->paginate($perPage);
      // } else {
      //    $groups = Group::latest()->paginate($perPage);
      // }

       $groups = Group::orderBy('orders','asc')->get();
       $i=0;$s=0;
       foreach($groups as $group) {
          $i++;
          if ($group->type=='0') $group->orders=$i;
          else {
            $s++;
            $group->orders=100+$s;
          }
          $group->save();
       }
       return view('admin.group.index')->with('groups', $groups)->with('cmd', 'index');
    //  return view('admin.group.xxxxxx')->with('groups', $groups);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.group.create')->with('cmd', 'create');
    }


   public function store(Request $request)
    {
      $validatedData = $request->validate([
         'title' => 'required',
         'description' => 'required'
      ]);

      $input = $request->all();
      $g_exists = Group::where('title','=',$input['title'])->exists();
      if($g_exists){
         return redirect('/admin/group')->with('error','Error! data already exists.');
      }
      else{
         $gs = new Group;
         $gs->type = $request->input('type');
         $gs->title = $request->input('title');
         $gs->status = ($request->input('status') == 1) ? '1':'0';
         $gs->description = $request->input('description');
         $gs->save();
//            $groups = Groups::orderBy('id', 'asc')->all();          
         return redirect('/admin/group')->with('success','Success! New Group has been Created.');
      }
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
      $group = Group::find($id);
      return view('admin.group.index')->with('group', $group)->with('cmd','edit');
    }


    public function change($switch, $id) {
      $group = Group::find($id);
      if ($switch == 'status') {
          $group->status = ($group->status != 1) ? '1':'0';
          $group->save();
      }
      if ($switch == 'oup') {

          $os=$group->orders - '1.6';
          $group->orders = $os;
          $group->save();
         //dd($os);
         $groups = Group::orderBy('orders','asc')->get();
         $i=0;
         foreach($groups as $group) {
            $i++;
            $group->orders=$i;
            $group->save();
         }
     }
     if ($switch == 'odown') {
         $os=$group->orders + '1.6';
         $group->orders = $os;
         $group->save();
         $groups = Group::orderBy('orders','asc')->get();
         $i=0;
         foreach($groups as $group) {
            $i++;
            $group->orders=$i;
            $group->save();
         }  
      }
      return redirect('admin/group')->with('success', ' Success! Group ID: '.$id.' has been Updated.');  
  }

  
   public function update(Request $request, $id)
   {
//dd($request);
      if (isset($request->switch)) {
         if ($request->switch) {
            return $this->change($request->switch,$id);
         }     
      }
      $validatedData = $request->validate([
         'title' => 'required',
         'description' => 'required'
     ]);
     $group = Group::find($id);
     $group->title = $request->input('title');
     $group->status = ($request->input('status') != 1) ? '0':'1';
     $group->description = ($request->input('description')) ? $request->input('description'):$group->title;
     $group->gid = $group->gid;
     $group->type = $request->input('type');
     $group->save();
     return redirect('admin/group')->with('success', ' Success! Group ID: '.$id.' has been Updated.');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $cat = Group::find($id);
      $cat->delete();
      return redirect()->back()->with('success', 'Group ID:'.$id.' has been Removed.'); 
    }
}

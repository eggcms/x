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
      $groups = Group::orderBy('orders','asc')->where('type',0)->get();
      $i=0;
      foreach($groups as $group) {
         $i++;
         $group->orders=$i;
         $group->save();
      }
      return view('admin.group.index')->with('groups', $groups)->with('cmd', 'index');
   }

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
         return redirect('/admin/group')->with('success','Success! New Group has been Created.');
      }
   }

   public function show($id)
   {
      //
   }

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
     }
     if ($switch == 'odown') {
         $os=$group->orders + '1.6';
         $group->orders = $os;
         $group->save();
      }

      return redirect('admin/group')->with('success', ' Success! Group ID: '.$id.' has been Updated.');  
   }

  
   public function update(Request $request, $id)
   {
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

   public function destroy($id)
   {
      $cat = Group::find($id);
      $cat->delete();
      return redirect()->back()->with('success', 'Group ID:'.$id.' has been Removed.'); 
   }
} 

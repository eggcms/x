<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Menu;
use DB;

class MenuController extends Controller
{

    public function index()
    {
        $menus=Menu::orderBy('orders','asc')->get();
        $i=0;
        $s=0;
        foreach($menus as $menu) {
           $i++;
           $menu->orders=$i;
           $menu->save();
        }
        return view('admin.menu.index')->with('cmd','index')->with('menus',$menus);
    }

    public function store(Request $request)
    {

        $b_exists = DB::table('menus')->where('title', $request->input('title'))->exists();
        if($b_exists) {
           return redirect()->back()->withInput()->with('error', 'Error! Manu Title has data already exists.');
        }
  
        $validatedData = $request->validate([
           'title' => 'required',
        ]);
  
        $menus = new Menu;
        $menus->uid = \Auth::user()->id;
        $menus->title = $request->input('title');
        $menus->link = $request->input('link');
        $menus->status = ($request->input('status') == true) ? '1':'0';       
        $menus->created_at = date('Y-m-d H:i:s');
        $menus->updated_at = date('Y-m-d H:i:s');
        $menus->save();
        return redirect('/admin/menu')->with('success','Success! New menu has been Created.');
  
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
       $menu = Menu::find($id);
       return view('admin.menu.index')->with('menu', $menu)->with('cmd','edit');
    }
 
    public function change($switch, $id) {
        $menu = Menu::find($id);
        if ($switch == 'status') {
            $menu->status = ($menu->status != 1) ? '1':'0';
            $menu->save();
        }
        if ($switch == 'oup') {
            $os=$menu->orders - '1.6';
            $menu->orders = $os;
            $menu->save();
           $menus = Menu::orderBy('orders','asc')->get();
           $i=0;
           foreach($menus as $menu) {
              $i++;
              $menu->orders=$i;
              $menu->save();
           }
       }
       if ($switch == 'odown') {
           $os=$menu->orders + '1.6';
           $menu->orders = $os;
           $menu->save();
           $menus = Menu::orderBy('orders','asc')->get();
           $i=0;
           foreach($menus as $menu) {
              $i++;
              $menu->orders=$i;
              $menu->save();
           }  
        }
        return redirect('admin/menu')->with('success', ' Success! Menu ID: '.$id.' has been Updated.');  
    }
 
 
    public function update(Request $request, $id)
    {
       if ($request->switch) {
          return $this->change($request->switch,$id);
       }
       $menus = Menu::find($id);
       $menus->title = $request->input('title');
       $menus->link = $request->input('link');
       $menus->updated_at = date('Y-m-d H:i:s');        
       $menus->save();
       return redirect('admin/menu')->with('success', ' Success! menu ID: '.$id.' has been Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::find($id);
        $menu->delete();
        return redirect()->back()->with('success', 'Menu ID:'.$id.' has been Removed.');  
    }
}

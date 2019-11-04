<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use DB;

class SetupController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth');
   }
    public function index()
    {
      if (Auth::user()->level >= 100) {
         return view('admin.config.index')->with('cmd','index');
      }
      else return redirect('admin')->with('error', ' Error! Your level is not authorized to use this section');
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
      $input = $request->all();
      $g_exists = DB::table('configs')->where('item','=',$input['item'])->exists();
      if($g_exists){
         $key = DB::table('configs')->where('item', $request->input('item'))-first();
         $key->data=$request->input('data');
         $key->save();
         return redirect('/admin/setup')->with('success','Success! New Group has been Created.');
      }
      else{
         $cgs = DB::table('configs')->insert(
            ['item' => $request->input('item'), 'data' => $request->input('data')]
         );
//       $groups = Groups::orderBy('id', 'asc')->all();          
         return redirect('/admin/setup')->with('success','Success! New Group has been Created.');
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
      $cfg = DB::table('configs')->find($id);
      return view('admin.config.index')->with('cfg', $cfg)->with('cmd','edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
   {
      DB::table('configs')->where('id', $id)->update(['item' => $request->item,'data'=>$request->data]);
      return redirect('admin/setup')->with('success', ' Success! Config ID: '.$id.' has been Updated.');
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      DB::table('configs')->where('id', $id)->delete();
      return redirect()->back()->with('success', 'Config ID:'.$id.' has been Removed.'); 
    }
}

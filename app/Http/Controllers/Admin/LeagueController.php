<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\League;
class LeagueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $leagues=League::orderBy('orders','asc')->get();
      $i=0;
      foreach($leagues as $league) {
         $i++;
         $league->orders=$i;
         $league->save();
      }
      return view('admin.league.index')->with('leagues',$leagues)->with('cmd', 'index');
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
      //dd($request);
      $validatedData = $request->validate([
         'title_th' => 'required',
         'title_en' => 'required',
      ]);

      $input = $request->all();
      $g_exists = League::where('title_th','=',$input['title_th'])->where('title_en',$input['title_en'])->exists();
      if($g_exists){
         return redirect('/admin/league')->with('error','Error! data already exists.');
      }
      else{
         $ls = new League;
         $ls->uid=\Auth::user()->id;
         $ls->title_th=$request->title_th;
         $ls->title_en=$request->title_en;
         $ls->orders=$request->order;
         $ls->created_at=now();
         $ls->updated_at=now();
         //dd($ls);
         $ls->save();
         return redirect('/admin/league')->with('success','Success! New League has been Created.');
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
      $league = League::find($id);
      return view('admin.league.index')->with('league', $league)->with('cmd','edit');
    }

    public function change($switch, $id) {
      $league = League::find($id);
      if ($switch == 'oup') {
          $os=$league->orders - '1.6';
          $league->orders = $os;
          $league->save();
         $leagues = League::orderBy('orders','asc')->get();
         $i=0;
         foreach($leagues as $league) {
            $i++;
            $league->orders=$i;
            $league->save();
         }
     }
     if ($switch == 'odown') {
         $os=$league->orders + '1.6';
         $league->orders = $os;
         $league->save();
         $leagues = League::orderBy('orders','asc')->get();
         $i=0;
         foreach($leagues as $league) {
            $i++;
            $league->orders=$i;
            $league->save();
         }  
      }
      return redirect('admin/league')->with('success', ' Success! League ID: '.$id.' has been Updated.');  
  }


   public function update(Request $request, $id)
   {
      if ($request->switch) {
         return $this->change($request->switch,$id);
      } 
      $validatedData = $request->validate([
         'title_th' => 'required',
         'title_en' => 'required',
      ]);

      $input = $request->all();
      $g_exists = League::where('title_th','=',$input['title_th'])->where('title_en',$input['title_en'])->exists();
      if($g_exists){
         return redirect('/admin/league')->with('error','Error! data already exists.');
      }
      else{
         $ls = League::find($id);
         $ls->uid=\Auth::user()->id;
         $ls->title_en=$request->title_en;
         $ls->title_th=$request->title_th;
         $ls->orders=$ls->orders;
         $ls->updated_at=now();
         $ls->save();
         return redirect('/admin/league')->with('success','Success! League has been Updated.');
      }
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function destroy($id)
   {
      $league = League::find($id);
      $league->delete();
      return redirect()->back()->with('success', 'League ID:'.$id.' has been Removed.'); 
   }
}

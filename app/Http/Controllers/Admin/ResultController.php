<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Result;
class ResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $results=Result::orderBy('id','desc')->get();
      return view('admin.result.index')->with('results',$results)->with('cmd', 'index');
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
       //dd($request->channel);
       $validatedData = $request->validate([
         'team1' => 'required',
         'team2' => 'required',
         'league' => 'required',
         'date' => 'required',
      ]);

      // $input = $request->all();
      // $g_exists = Review::where('team1','=',$input['team1'])->where('team2',$input['team2'])->exists();
      // if($g_exists){
      //    return redirect('/admin/review')->with('error','Error! data already exists.');
      // }
      // else{
         
         $results = new Result;
         $results->uid=\Auth::user()->id;
         $results->league=$request->league;
         $results->team1=$request->team1;
         $results->team2=$request->team2;
         $results->score1=($request->score1)?$request->score1:'?';
         $results->score2=($request->score2)?$request->score2:'?';
         $results->channel=$request->channel;
         $results->date=$request->date;
         $results->hot=0;
         $results->created_at=now();
         $results->updated_at=now();
         //dd($results);
         $results->save();
      
         return redirect('/admin/result')->with('success','Success! New Result has been Created.');
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
      $result=Result::where('id',$id)->first();
      return view('admin.result.index')->with('result',$result)->with('cmd','edit');
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
      // dd($request->channel);
       $validatedData = $request->validate([
         'team1' => 'required',
         'team2' => 'required',
         'league' => 'required',
         'date' => 'required',
      ]);

      // $input = $request->all();
      // $g_exists = Review::where('team1','=',$input['team1'])->where('team2',$input['team2'])->exists();
      // if($g_exists){
      //    return redirect('/admin/review')->with('error','Error! data already exists.');
      // }
      // else{
         
         $result = Result::find($id);
         $result->uid=\Auth::user()->id;
         $result->league=$request->league;
         $result->team1=$request->team1;
         $result->team2=$request->team2;
         $result->score1=($request->score1)?$request->score1:'?';
         $result->score2=($request->score2)?$request->score2:'?';
         $result->channel=$request->channel;
         $result->date=$request->date;
         $result->updated_at=now();
         //dd($results);
         $result->save();
      
         return redirect('/admin/result')->with('success','Success! New Result has been Updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $res = Result::find($id);
      $res->delete();
      return redirect()->back()->with('success', 'Result ID:'.$id.' has been Removed.'); 
    }
}

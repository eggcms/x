<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Review;
use App\User;
use DB;


class ReviewController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth');
   }
    public function index()
    {
      $reviews=Review::orderBy('id', 'desc')->get();
      //$reviews=Review::where('status', 1)->orderBy('id', 'desc')->get();
      // $reviews=Review::where('active', 1)->orderBy('name', 'desc')->take(10)->get();
      return view('admin.review.index')->with('reviews', $reviews)->with('cmd', 'index');
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
      //dd($request->over);
      $validatedData = $request->validate([
         'team1' => 'required',
         'team2' => 'required',
         'league' => 'required',
         'over' => 'required',
         'content' => 'required',
         'bet' => 'required',
         'prevision' => 'required',
      ]);

      $input = $request->all();
      $g_exists = Review::where('team1','=',$input['team1'])->where('team2',$input['team2'])->exists();
      if($g_exists){
         return redirect('/admin/review')->with('error','Error! data already exists.');
      }
      else{
         
         $rs = new Review;
         $rs->uid=\Auth::user()->id;
         $rs->league=$request->league;
         $rs->team1=$request->team1;
         $rs->team2=$request->team2;
         $rs->over=$request->over;
         $rs->bet=$request->bet;
         $rs->content=$request->content;
         $rs->prevision=$request->prevision;
         $rs->status=$request->status;
         $rs->created_at=now();
         $rs->updated_at=now();
         $rs->save();
      
         return redirect('/admin/review')->with('success','Success! New Review has been Created.');
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
      $review=Review::where('id',$id)->first();
      return view('admin.review.index')->with('review',$review)->with('cmd','edit');
    }


    public function change($switch, $id) {
      $review = Review::find($id);
      if ($switch == 'status') {
          $review->status = ($review->status != 1) ? '1':'0';
      }

      $review->save();
      return redirect('admin/review')->with('success', ' Success! Review ID: '.$id.' has been Updated.'); 
  }



    public function update(Request $request, $id)
    {
      if ($request->switch) {
         return $this->change($request->switch,$id);
      } 
//      dd($request->switch);
      //dd($request->over);
      $validatedData = $request->validate([
         'team1' => 'required',
         'team2' => 'required',
         'league' => 'required',
         'over' => 'required',
         'content' => 'required',
         'bet' => 'required',
         'prevision' => 'required',
      ]);

      $input = $request->all();
      $g_exists = Review::where('team1',$input['team1'])->where('team2',$input['team2'])->where('id','!=',$id)->exists();
      if($g_exists){
         return redirect('/admin/review')->with('error','Error! data already exists.');
      }
      else{
         $rs = Review::find($id);
         //$rs->uid=\Auth::user()->id;
         $rs->league=$request->league;
         $rs->team1=$request->team1;
         $rs->team2=$request->team2;
         $rs->over=$request->over;
         $rs->bet=$request->bet;
         $rs->content=$request->content;
         $rs->prevision=$request->prevision;
         $rs->status=$request->status;
         //$rs->created_at=now();
         $rs->updated_at=now();
         $rs->save();
         return redirect('/admin/review')->with('success','Success! Review has been Updated.');
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
      $rev = Review::find($id);
      $rev->delete();
      return redirect()->back()->with('success', 'Review ID:'.$id.' has been Removed.'); 
    }
}

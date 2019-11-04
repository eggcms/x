<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use DB;

class AdminController extends Controller
{
   public function __construct()
   {
       $this->middleware('auth');
   }
   public function index()
   {
      //echo uri();
      //return data('page_active');
       return view('admin.index');
   }
   public function member() {
      $users=DB::table('users')->orderBy('level','asc')->get();
      return view('admin.user.index')->with('users', $users)->with('cmd','member');
   }
   public function memberUpdate($id) {
      dd($id);
   }

}

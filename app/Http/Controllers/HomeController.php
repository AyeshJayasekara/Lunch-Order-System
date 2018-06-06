<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordered = false;
        $selected='';
        $places = DB::table('Departments')->get();
        $menu = DB::table('menu')->get();

        $myPlaceID = DB::table('Employees')->where('email', Auth::user()->email)->first();

        $order = DB::table('orders')->where('email', Auth::user()->email)->where('date', date("Y/m/d"))->first();

        if(!empty($order)) {
            $ordered = true;
            $selected = DB::table('menu')->where('id', $order->prefer)->value('type');
        }

        $myplace = DB::table('Departments')->where('id', $myPlaceID->Faculty)->first();

        if($myplace == NULL)
            return view('home',['places' => $places, 'menu' => $menu , 'msg' => '' , 'ordered'=>$ordered,  'selected'=>$selected])->with('myplace', 'No Place Selected');
        else
            return view('home',['places' => $places ,  'menu' => $menu , 'msg' => '', 'ordered'=>$ordered,  'selected'=>$selected])->with('myplace', $myplace->Dname);

    }


    public function admin(){
        if(Auth::user()->email == config('app.adminemail')){
            $today = DB::table('Final_Orders')->get();
            return view('admin',['today'=>$today]);
        }
        else
            return redirect('home');
    }

    public function adminSummary(){
        if(Auth::user()->email == config('app.adminemail')){
            $today = DB::table('Final_Orders')->get();
            $summary = DB::select("select DISTINCT type, count(type) as Total, Dname from Final_Orders GROUP BY type,Dname ORDER BY Dname");
            return view('adminsummary',['summary'=>$summary]);
        }
        else
            return redirect('home');
    }

}

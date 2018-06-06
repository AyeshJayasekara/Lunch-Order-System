<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    //
    public function setDept(Request $request){

        $place = $request->input('place');

        DB::table('Employees')
            ->where('email', Auth::user()->email )
            ->update(['Faculty' => $place]);

        return redirect('home');
    }


    public function placeOrder(Request $request){

        $choice = $request->input('menu');
        $ordered=false;

        $places = DB::table('Departments')->get();
        $menu = DB::table('menu')->get();

        $myPlaceID = DB::table('Employees')->where('email', Auth::user()->email)->first();

        $myplace = DB::table('Departments')->where('id', $myPlaceID->Faculty)->first();

        if($myplace == NULL)
            return view('home',['places' => $places, 'menu' => $menu , 'msg' => '', 'ordered'=>$ordered])->with('myplace', 'No Place Selected');


        if($choice == "NULL")
            return view('home',['places' => $places, 'menu' => $menu, 'msg'=> 'Please select your choice first!', 'ordered'=>$ordered])->with('myplace', $myplace->Dname);
        else
        {
            DB::insert('insert into Orders (email,date,prefer) values (:email, :date, :prefer)', ['email' => Auth::user()->email, 'date'=> date("Y/m/d"), 'prefer'=>$choice  ]);
        }


        return redirect('home');
    }


    public function changeOrder(Request $request){

        $choice = $request->input('menu');
        $ordered=false;

        $places = DB::table('Departments')->get();
        $menu = DB::table('menu')->get();

        $myPlaceID = DB::table('Employees')->where('email', Auth::user()->email)->first();

        $myplace = DB::table('Departments')->where('id', $myPlaceID->Faculty)->first();

        if($myplace == NULL)
            return view('home',['places' => $places, 'menu' => $menu , 'msg' => '', 'ordered'=>$ordered])->with('myplace', 'No Place Selected');


        if($choice == "NULL")
            return view('home',['places' => $places, 'menu' => $menu, 'msg'=> 'Please select your choice first!', 'ordered'=>$ordered])->with('myplace', $myplace->Dname);
        else
        {
            DB::table('orders')->where('email', Auth::user()->email)->where('date',date("Y/m/d"))->update(['prefer' => $choice ]);
            //DB::insert('insert into Orders (email,date,prefer) values (:email, :date, :prefer)', ['email' => Auth::user()->email, 'date'=> date("Y/m/d"), 'prefer'=>$choice  ]);
        }

        return redirect('home');
    }

    public function cancelOrder(Request $request){

        DB::table('orders')->where('email', Auth::user()->email)->where('date',date("Y/m/d"))->delete();

        return redirect('home');
    }







}

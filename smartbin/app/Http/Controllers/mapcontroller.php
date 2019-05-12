<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\bin;
use App\route;
use App\issue;
use DateTime;
class mapcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bins = bin::with('issue')->get();
        return view('map',['bins'=>$bins]);
    }

    public function route($id)
    {
        $route= route::find($id);
        $bin1= bin::find($route->bin1);
        $bin2= bin::find($route->bin2);
        $bin3= bin::find($route->bin3);
        $bin4= bin::find($route->bin4);
        $bin5= bin::find($route->bin5);
        $bin6= bin::find($route->bin6);
        $bin7= bin::find($route->bin7);
        $bin8= bin::find($route->bin8);
        $bin9= bin::find($route->bin9);
        $bin10= bin::find($route->bin10);
        $bins=collect([$bin1,$bin2,$bin3,$bin4,$bin5,$bin6,$bin7,$bin8,$bin9,$bin10]);
        return view('route',['bins'=>$bins]);
    }
    public function fire()
    {
        $bins=bin::where('temp','>','100')->get();
        return view('map',['bins'=>$bins]);
    }
    public function clean()
    {
        $date = new DateTime;
        $date->modify('-1 Year');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $bins=bin::where('lastclean','<=',$formatted_date)->get();
        return view('map',['bins'=>$bins]);
    }
    public function maintenancemap()
    {
        $date = new DateTime;
        $date->modify('-1 Year');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $bins1=bin::where('lastclean','<=',$formatted_date)->get();
        $bins2=bin::where('temp','>','100')->get();
        $bins=$bins1->merge($bins2);
        return view('map',['bins'=>$bins]);
    }
    public function maintenancerep()
    {
        $date = new DateTime;
        $date->modify('-1 Year');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $bins1=bin::where('lastclean','<=',$formatted_date)->get();
        $bins2=bin::where('temp','>','100')->get();
        $bins=$bins1->merge($bins2);
        return view('report',['bins'=>$bins]);
    }
    public function apiget()
    {
        $route= route::where('user_id','=','1')->first();
        $bin1= bin::find($route->bin1);
        $bin2= bin::find($route->bin2);
        $bin3= bin::find($route->bin3);
        $bin4= bin::find($route->bin4);
        $bin5= bin::find($route->bin5);
        $bin6= bin::find($route->bin6);
        $bin7= bin::find($route->bin7);
        $bin8= bin::find($route->bin8);
        $bin9= bin::find($route->bin9);
        $bin10= bin::find($route->bin10);
        $bins=collect([$bin1,$bin2,$bin3,$bin4,$bin5,$bin6,$bin7,$bin8,$bin9,$bin10]);
        return response()->json($bins);
    }
    public function apiremove()
    {
        
    }
   
}

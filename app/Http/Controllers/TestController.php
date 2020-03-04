<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Province;
use App\District;
class TestController extends Controller
{
    public function provfunct(){
        
        $prov=Province::all();
        return view('user.create',compact('prov'));
    }

    public function findDistrictName( Request $request){
        $data=District::select('DISTRICT_NAME','DISTRICT_ID')->where('PROVINCE_ID',$request
        ->id)->take(100)->get();

        return response()->json($data);
    }

    public function findcode( Request $request){
        $data=District::select('POSTCODE')->where('DISTRICT_ID',$request->id)->first();

        return response()->json($data);
    }


    
    
}

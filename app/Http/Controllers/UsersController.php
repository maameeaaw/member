<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Province;
use App\Info;
use App\District;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Info::all()->toArray();
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $prov=Province::all();
        return view('user.create',compact('prov'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)//บันทึกข้อมูล
    {
        // dd($request);
        $this->validate($request, [ 'fname'=>'required' , 'lname'=>'required', 'tel'=>'required', 'email'=>'required', 'address'=>'required'
        , 'province'=>'required', 'district'=>'required', 'code'=>'required']);
        $proid = $request->get('province');
        
        $disid = $request->get('district');
        
        $dis=District::select('DISTRICT_NAME')->where('DISTRICT_ID',$disid)->first();
        // dd($pro);
        $user = new Info([ 
            'fname' => $request->get('fname'),
            'lname' => $request->get('lname'),
            'tel' => $request->get('tel'),
            'email' => $request->get('email'),
            'address' => $request->get('address'),
            'province' => $request->get('province'),
            'district' => $request->get('district'),
            'code' => $request->get('code')
        ]);
        $user->save();
        return redirect()->route('user.index')->with('success','บันทึกข้อมูลเรียบร้อย');
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
        $user = Info::find($id);
        $prov=Province::all();
        // dd($user);
        return view('user.edit',compact('user','id','prov'));
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
        $this->validate($request, [ 'fname'=>'required' , 'lname'=>'required', 'tel'=>'required', 'email'=>'required', 'address'=>'required'
        , 'province'=>'required', 'district'=>'required', 'code'=>'required']);
            $user = Info::find($id);
            $user->fname = $request->get('fname');
            $user->lname = $request->get('lname');
            $user->tel = $request->get('tel');
            $user->email = $request->get('email');
            $user->address = $request->get('address');
            $user->province = $request->get('province');
            $user->district = $request->get('district');
            $user->code = $request->get('code');
        
        $user->save();
        return redirect()->route('user.index')->with('success','อัพเดตข้อมูลเรียบร้อย');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)    {
        // dd($id);
        $user = Info::find($id);
        $user->delete();
        return redirect()->route('user.index')->with('success','ลบข้อมูลเรียบร้อย');
    }
    public function provfunct(){
        
        $prov=Province::all();
        return view('user.create',compact('prov'));
    }

    public function findDistrictName( Request $request){
        // $pro=Province::find($request->id);
        
        $pro=Province::select('id')->where('PROVINCE_NAME',$request->id)->first();
        
        $data=District::select('DISTRICT_NAME','DISTRICT_NAME')->where('PROVINCE_ID',$pro->id)->take(100)->get();
        // $data=District::select('DISTRICT_NAME','DISTRICT_ID')->where('PROVINCE_ID',$request
        // ->id)->take(100)->get();

        return response()->json($data);
    }

    public function findcode( Request $request){
        $data=District::select('POSTCODE')->where('DISTRICT_NAME',$request->id)->first();

        return response()->json($data);
    }


}

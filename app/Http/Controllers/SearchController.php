<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class SearchController extends Controller
{
    function search(){
        return view('user.search');
    }

    function action(Request $request){
        if($request->ajax()){
            $output ='';
            $result=$request->get('query');
            if($result!=''){
                $data = DB::table('infos')
                ->where('fname','like','%'.$result.'%')
                ->orwhere('lname','like','%'.$result.'%')->get();
            }else{
                $data = DB::table('infos')->get();
            }
            $total_row = $data->count();
            if($total_row>0){
                foreach($data as $row){
                    $output.='<tr>
                    <td>'.$row->id.'</td>
                    <td>'.$row->fname.'</td>
                    <td>'.$row->lname.'</td>
                    <td>'.$row->tel.'</td>
                    <td>'.$row->email.'</td>
                    <td>'.$row->address.'</td>
                    <td>'.$row->province.'</td>
                    <td>'.$row->district.'</td>
                    <td>'.$row->code.'</td>
                    </tr>';
                }
            }else{
                $output = "<tr><td align = 'center' colspan = '15' >ไม่พบข้อมูล</td></tr>";
            }
            $data = array('table_data'=>$output,'total_data'=>$total_row);
            echo json_encode($data);
        }
    }
}

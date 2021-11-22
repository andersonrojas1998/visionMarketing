<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\response;
class SearchController extends Controller
{

    public function index()
    {
        return view('task.indexSearch');
    }    
    public function service($fullname,$per){

        $data=\DB::SELECT("SELECT * FROM search");      
        $return=[];
            foreach($data as  $d){

                $data1=self::clear($d->nombre);
                $data2=self::clear($fullname);
                $res=similar_text($data1, $data2,$percent);
                                        
                if( intval(number_format(round($percent)))  >=  intval(number_format(round($per)))  ){
                    $return[]=$d;
                }                
            }

            $newobj= new response();            
            $newobj->nombre_buscado=$fullname;
            $newobj->porcentaje_buscado=$per;
            $newobj->estado_ejecucion=json_encode($return);
            $newobj->save();

        return response()->json(['success'=>true,'data'=>$return],201);        
    }
    public function clear($data){
        return  str_replace(' ', '',strtoupper(trim($data)));        
    }
}

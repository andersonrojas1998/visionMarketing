<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Curl\Curl;
use App\Model\abbreviations;
use App\Model\meaning;
use DB;
class AcronimeController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('acronime.index');
    }
    
    public function searchingAcronime($key)
    {
        
        
        try {


            DB::transaction(function()use ($key){


                $curl = new Curl();
                $curl->get('http://www.nactem.ac.uk/software/acromine/dictionary.py', [
                    'sf' => $key,
                ]);
                $response=json_decode($curl->response);

                foreach($response as $key=> $res){
                    $ab= new abbreviations();
                    $ab->sf=$res->sf ;
                    $ab->save();
                
                    if(!empty($res->lfs)){
                        foreach($res->lfs as $meaning){
                            
                            $m= new  meaning();
                            $m->lf=$meaning->lf;
                            $m->freq=$meaning->freq;
                            $m->since=$meaning->since;
                            $m->vars=json_encode($meaning->vars);
                            $m->id_abbreviation=$ab->id;
                            $m->save();
    
    
                        }
    
                    }
                }

               
            });

            return DB::SELECT("SELECT * FROM  abbreviations AS a inner join  meaning as b ON a.id=b.id_abbreviation ");            

        } catch (\PDOException $th) {
                return $th->getMessage();
        }

        

        
    }
}

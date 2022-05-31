<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CPUBrand;
use Illuminate\Support\Facades\DB;

class CPUBrandController extends Controller
{
    public function index()
    {
        $CPUBrand = DB::table('CPUBrand')->select('idCPUBrand', 'CPUBrand')->get();
        $json = array(

            "status"=>200,
            "records"=>count($CPUBrand),
            "details"=>$CPUBrand
            
        );
        return json_encode($json, true);
    }

    public function show($id)
    {
        if (!empty(CPUBrand::where("idCPUBrand", $id)->get()) && count(CPUBrand::where("idCPUBrand", $id)->get()) > 0) {
            $json = array(

                "status"=>200,
                "details"=>CPUBrand::where("idCPUBrand", $id)->get()
                
            );
            
            return json_encode($json, true);
        } else {
            $json = array(

                "status"=>404,
                "details"=>'That CPU Brand is not registered'
                
            );
            
            return json_encode($json, true);
        }
    }
}

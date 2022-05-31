<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScreenMaterial;
use Illuminate\Support\Facades\DB;

class ScreenMaterialController extends Controller
{
    public function index()
    {
        $ScreenMaterial = DB::table('ScreenMaterial')->select('idScreenMaterial', 'Material', 'Score')->get();
        $json = array(

            "status"=>200,
            "records"=>count($ScreenMaterial),
            "details"=>$ScreenMaterial
            
        );
        return json_encode($json, true);
    }

    public function show($id)
    {
        if (!empty(ScreenMaterial::where("idScreenMaterial", $id)->get()) && count(ScreenMaterial::where("idScreenMaterial", $id)->get()) > 0) {
            $json = array(

                "status"=>200,
                "details"=>ScreenMaterial::where("idScreenMaterial", $id)->get()
                
            );
            
            return json_encode($json, true);
        } else {
            $json = array(

                "status"=>404,
                "details"=>'That Brand is not registered'
                
            );
            
            return json_encode($json, true);
        }
    }
}

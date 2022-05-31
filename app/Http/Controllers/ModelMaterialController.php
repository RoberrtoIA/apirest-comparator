<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelMaterial;
use Illuminate\Support\Facades\DB;

class ModelMaterialController extends Controller
{
    public function index()
    {
        $ModelMaterial = DB::table('ModelMaterial')->select('idModelMaterial', 'Material', 'Score')->get();
        $json = array(

            "status"=>200,
            "records"=>count($ModelMaterial),
            "details"=>$ModelMaterial
            
        );
        return json_encode($json, true);
    }

    public function show($id)
    {
        if (!empty(ModelMaterial::where("idModelMaterial", $id)->get()) && count(ModelMaterial::where("idModelMaterial", $id)->get()) > 0) {
            $json = array(

                "status"=>200,
                "details"=>ModelMaterial::where("idModelMaterial", $id)->get()
                
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

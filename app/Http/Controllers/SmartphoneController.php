<?php

namespace App\Http\Controllers;

use App\Models\Models;
use App\Models\Smartphone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SmartphoneController extends Controller
{
    public function index()
    {
        $Model = DB::table('Smartphones')->select('*')->where("Available", 1)->get();
        $json = array(

            "status" => 200,
            "records" => count($Model),
            "details" => $Model

        );
        return json_encode($json, true);
    }

    public function show($id)
    {
        if (!empty(Smartphone::where("idModel", $id)->get()) && count(Smartphone::where("idModel", $id)->get()) > 0) {
            $json = array(

                "status" => 200,
                "details" => Smartphone::where("idModel", $id)->get()

            );

            return json_encode($json, true);
        } else {
            $json = array(

                "status" => 404,
                "details" => 'That Smartphone is not registered'

            );

            return json_encode($json, true);
        }
    }

    public function compare(Request $request)
    {
        $Smartphones = Smartphone::all();

        $smartOne = Smartphone::where("idModel", $request->input("smartphone1"))->get();
        $smartTwo = Smartphone::where("idModel", $request->input("smartphone2"))->get();

        if ((!empty($smartOne) && (count($smartOne) > 0)) && (!empty($smartTwo) && (count($smartTwo) > 0))) {
            $smartOneModel = Smartphone::select("Smartphone")->where("idModel", $request->input("smartphone1"))->get();
            $smartTwoModel = Smartphone::select("Smartphone")->where("idModel", $request->input("smartphone2"))->get();

            $smartOnePoints = 0;
            $smartTwoPoints = 0;
            $winner = null;
            $losser = null;
            $model = null;

            // (Smartphone::select("ScreenSize")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("ScreenSize")->where("idModel", $request->input("smartphone2"))->get()) ? $smartOnePoints++ : $smartTwoPoints++;
            // (Smartphone::select("PixelDensity")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("PixelDensity")->where("idModel", $request->input("smartphone2"))->get()) ? $smartOnePoints++ : $smartTwoPoints++;
            // (Smartphone::select("BatteryPower")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("BatteryPower")->where("idModel", $request->input("smartphone2"))->get()) ? $smartOnePoints++ : $smartTwoPoints++;
            // (Smartphone::select("RAM")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("RAM")->where("idModel", $request->input("smartphone2"))->get()) ? $smartOnePoints++ : $smartTwoPoints++;
            // (Smartphone::select("ResolutionX")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("ResolutionX")->where("idModel", $request->input("smartphone2"))->get()) ? $smartOnePoints++ : $smartTwoPoints++;
            // (Smartphone::select("ResolutionY")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("ResolutionY")->where("idModel", $request->input("smartphone2"))->get()) ? $smartOnePoints++ : $smartTwoPoints++;
            // (Smartphone::select("FrontMainCamera")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("FrontMainCamera")->where("idModel", $request->input("smartphone2"))->get()) ? $smartOnePoints++ : $smartTwoPoints++;
            // (Smartphone::select("BackMainCamera")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("BackMainCamera")->where("idModel", $request->input("smartphone2"))->get()) ? $smartOnePoints++ : $smartTwoPoints++;
            // (Smartphone::select("Weight")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("Weight")->where("idModel", $request->input("smartphone2"))->get()) ? $smartOnePoints++ : $smartTwoPoints++;
            // (Smartphone::select("Waterproof")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("Waterproof")->where("idModel", $request->input("smartphone2"))->get()) ? $smartOnePoints++ : $smartTwoPoints++;
            // (Smartphone::select("RefreshRate")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("RefreshRate")->where("idModel", $request->input("smartphone2"))->get()) ? $smartOnePoints++ : $smartTwoPoints++;
            // (Smartphone::select("Score")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("Score")->where("idModel", $request->input("smartphone2"))->get()) ? $smartOnePoints++ : $smartTwoPoints++;
            // (Smartphone::select("ModelMaterial.Score")->join('ModelMaterial', 'Smartphones.material', '=', 'ModelMaterial.Score')->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("ModelMaterial.Score")->join('ModelMaterial', 'Smartphones.material', '=', 'ModelMaterial.Score')->where("idModel", $request->input("smartphone2"))->get()) ? $smartOnePoints++ : $smartTwoPoints++;
            // (Smartphone::select("Glass.Score")->join('Glass', 'Smartphones.glass', '=', 'Glass.glass')->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("Glass.Score")->join('Glass', 'Smartphones.glass', '=', 'Glass.glass')->where("idModel", $request->input("smartphone2"))->get()) ? $smartOnePoints++ : $smartTwoPoints++;

            if (Smartphone::select("ScreenSize")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("ScreenSize")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartOnePoints++;
            } else if (Smartphone::select("ScreenSize")->where("idModel", $request->input("smartphone1"))->get() < Smartphone::select("ScreenSize")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartTwoPoints++;
            }

            if (Smartphone::select("PixelDensity")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("PixelDensity")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartOnePoints++;
            } else if (Smartphone::select("PixelDensity")->where("idModel", $request->input("smartphone1"))->get() < Smartphone::select("PixelDensity")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartTwoPoints++;
            }

            if (Smartphone::select("BatteryPower")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("BatteryPower")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartOnePoints++;
            } else if (Smartphone::select("BatteryPower")->where("idModel", $request->input("smartphone1"))->get() < Smartphone::select("BatteryPower")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartTwoPoints++;
            }

            if (Smartphone::select("RAM")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("RAM")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartOnePoints++;
            } else if (Smartphone::select("RAM")->where("idModel", $request->input("smartphone1"))->get() < Smartphone::select("RAM")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartTwoPoints++;
            }

            if (Smartphone::select("ResolutionX")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("ResolutionX")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartOnePoints++;
            } else if (Smartphone::select("ResolutionX")->where("idModel", $request->input("smartphone1"))->get() < Smartphone::select("ResolutionX")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartTwoPoints++;
            }

            if (Smartphone::select("ResolutionY")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("ResolutionY")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartOnePoints++;
            } else if (Smartphone::select("ResolutionY")->where("idModel", $request->input("smartphone1"))->get() < Smartphone::select("ResolutionY")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartTwoPoints++;
            }

            if (Smartphone::select("FrontMainCamera")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("FrontMainCamera")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartOnePoints++;
            } else if (Smartphone::select("FrontMainCamera")->where("idModel", $request->input("smartphone1"))->get() < Smartphone::select("FrontMainCamera")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartTwoPoints++;
            }

            if (Smartphone::select("BackMainCamera")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("BackMainCamera")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartOnePoints++;
            } else if (Smartphone::select("BackMainCamera")->where("idModel", $request->input("smartphone1"))->get() < Smartphone::select("BackMainCamera")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartTwoPoints++;
            }

            if (Smartphone::select("Weight")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("Weight")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartOnePoints++;
            } else if (Smartphone::select("Weight")->where("idModel", $request->input("smartphone1"))->get() < Smartphone::select("Weight")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartTwoPoints++;
            }

            if (Smartphone::select("Waterproof")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("Waterproof")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartOnePoints++;
            } else if (Smartphone::select("Waterproof")->where("idModel", $request->input("smartphone1"))->get() < Smartphone::select("Waterproof")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartTwoPoints++;
            }

            if (Smartphone::select("RefreshRate")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("RefreshRate")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartOnePoints++;
            } else if (Smartphone::select("RefreshRate")->where("idModel", $request->input("smartphone1"))->get() < Smartphone::select("RefreshRate")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartTwoPoints++;
            }

            if (Smartphone::select("Score")->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("Score")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartOnePoints++;
            } else if (Smartphone::select("Score")->where("idModel", $request->input("smartphone1"))->get() < Smartphone::select("Score")->where("idModel", $request->input("smartphone2"))->get()) {
                $smartTwoPoints++;
            }

            if (Smartphone::select("ModelMaterial.Score")->join('ModelMaterial', 'Smartphones.material', '=', 'ModelMaterial.Score')->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("ModelMaterial.Score")->join('ModelMaterial', 'Smartphones.material', '=', 'ModelMaterial.Score')->where("idModel", $request->input("smartphone2"))->get()) {
                $smartOnePoints++;
            } else if (Smartphone::select("ModelMaterial.Score")->join('ModelMaterial', 'Smartphones.material', '=', 'ModelMaterial.Score')->where("idModel", $request->input("smartphone1"))->get() < Smartphone::select("ModelMaterial.Score")->join('ModelMaterial', 'Smartphones.material', '=', 'ModelMaterial.Score')->where("idModel", $request->input("smartphone2"))->get()) {
                $smartTwoPoints++;
            }

            if (Smartphone::select("Glass.Score")->join('Glass', 'Smartphones.glass', '=', 'Glass.glass')->where("idModel", $request->input("smartphone1"))->get() > Smartphone::select("Glass.Score")->join('Glass', 'Smartphones.glass', '=', 'Glass.glass')->where("idModel", $request->input("smartphone2"))->get()) {
                $smartOnePoints++;
            } else if (Smartphone::select("Glass.Score")->join('Glass', 'Smartphones.glass', '=', 'Glass.glass')->where("idModel", $request->input("smartphone1"))->get() < Smartphone::select("Glass.Score")->join('Glass', 'Smartphones.glass', '=', 'Glass.glass')->where("idModel", $request->input("smartphone2"))->get()) {
                $smartTwoPoints++;
            }

            if ($smartOnePoints > $smartTwoPoints) {
                $winner = $smartOnePoints;
                $losser = $smartTwoPoints;
                $model = $smartOneModel;
            } else if ($smartOnePoints < $smartTwoPoints) {
                $winner = $smartTwoPoints;
                $losser = $smartOnePoints;
                $model = $smartTwoModel;
            } else {
                $winner = $smartTwoPoints;
                $losser = $smartOnePoints;
                $model = "Equally good";
            }



            if (!empty($smartOne) && !empty($smartTwo)) {
                $json = array(

                    "status" => 200,
                    "details" => array($smartOne, $smartTwo),
                    "model winner" => $model,
                    "difference" => ($winner - $losser),
                    "winner points" => $winner,
                    "losser points" => $losser
                );

                return json_encode($json, true);
            } else {
                $json = array(

                    "status" => 404,
                    "details" => 'One or more of the selected smartphones did not match with the records'

                );

                return json_encode($json, true);
            }
        } else {
            $json = array(

                "status"=>404,
                "details"=>'One or two ids are not registered'
                
            );
            
            return json_encode($json, true);
        }
    }
}

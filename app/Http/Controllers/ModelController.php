<?php

namespace App\Http\Controllers;

use App\Models\Models;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ModelController extends Controller
{
    public function index()
    {
        $Model = DB::table('Model')->select('*')->get();
        $json = array(

            "status" => 200,
            "records" => count($Model),
            "details" => $Model

        );
        return json_encode($json, true);
    }

    public function show($id)
    {
        if (!empty(Models::where("idModel", $id)->get()) && count(Models::where("idModel", $id)->get()) > 0) {
            $json = array(

                "status" => 200,
                "details" => Models::where("idModel", $id)->get()

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

    public function store(Request $request)
    {
        $token = $request->header('Authorization');
        $users = User::select("*")->get();
        $json = array();

        foreach ($users as $key => $user) {
            if ("Basic " . base64_encode($user["PASSWORD"] . ":" . $user["remember_token"]) == $token) {
                $id = null;
                foreach (Models::select('idModel')->orderBy('idModel', 'desc')->first()->get() as $key => $value) {
                    $id = $value;
                }
                $json = array();
                $records = array(
                    "idModel" => ($id['idModel'] + 1),
                    "Serie" => $request->input("serie"),
                    "YEAR" => $request->input("year"),
                    "ScreenSize" => $request->input("screensize"),
                    "PixelDensity" => $request->input("pixeldensity"),
                    "BatteryPower" => $request->input("batterypower"),
                    "RAM" => $request->input("ram"),
                    "ResolutionX" => $request->input("resolutionx"),
                    "ResolutionY" => $request->input("resolutiony"),
                    "FrontMainCamera" => $request->input("frontmaincamera"),
                    "BackMainCamera" => $request->input("backmaincamera"),
                    "Weight" => $request->input("weight"),
                    "Waterproof" => $request->input("waterproof"),
                    "RefreshRate" => $request->input("refreshrate"),
                    "idOS" => $request->input("idos"),
                    "idModelMaterial" => $request->input("idmodelmaterial"),
                    "idScreenMaterial" => $request->input("idscreenmaterial"),
                    "idGlass" => $request->input("idglass"),
                    "idCPU" => $request->input("idcpu"),
                    "idModelBrand" => $request->input("idmodelbrand"),
                    "STATUS" => "Active",
                    "Available" => 1
                );

                if (!empty($records)) {
                    $validator = Validator::make(
                        $records,
                        [
                            'idModel' => 'required|integer',
                            'Serie' => 'required|string|unique:Model',
                            'YEAR' => 'required|string',
                            'ScreenSize' => 'required|numeric',
                            'PixelDensity' => 'required|numeric',
                            'BatteryPower' => 'required|integer',
                            'RAM' => 'required|integer',
                            'ResolutionX' => 'required|integer',
                            'ResolutionY' => 'required|integer',
                            'FrontMainCamera' => 'required|integer',
                            'BackMainCamera' => 'required|integer',
                            'Weight' => 'required|integer',
                            'Waterproof' => 'required|integer',
                            'RefreshRate' => 'required|integer',
                            'idOS' => 'required|integer|exists:OS,idOS',
                            'idModelMaterial' => 'required|integer|exists:ModelMaterial,idModelMaterial',
                            'idScreenMaterial' => 'required|integer|exists:ScreenMaterial,idScreenMaterial',
                            'idGlass' => 'required|integer|exists:Glass,idGlass',
                            'idCPU' => 'required|integer|exists:CPU,idCPU',
                            'idModelBrand' => 'required|integer|exists:ModelBrand,idModelBrand',
                            'STATUS' => 'required|string',
                            'Available' => 'required'
                        ]
                    );

                    if ($validator->fails()) {
                        $errors = $validator->errors();

                        $json = array(
                            "status" => 404,
                            "error" => $errors
                        );

                        return json_encode($json, true);
                    } else {
                        $model = new Models();
                        $model->idModel = $records["idModel"];
                        $model->Serie = $records["Serie"];
                        $model->YEAR = $records["YEAR"];
                        $model->ScreenSize = $records["ScreenSize"];
                        $model->PixelDensity = $records["PixelDensity"];
                        $model->BatteryPower = $records["BatteryPower"];
                        $model->RAM = $records["RAM"];
                        $model->ResolutionX = $records["ResolutionX"];
                        $model->ResolutionY = $records["ResolutionY"];
                        $model->FrontMainCamera = $records["FrontMainCamera"];
                        $model->BackMainCamera = $records["BackMainCamera"];
                        $model->Weight = $records["Weight"];
                        $model->Waterproof = $records["Waterproof"];
                        $model->RefreshRate = $records["RefreshRate"];
                        $model->idOS = $records["idOS"];
                        $model->idModelMaterial = $records["idModelMaterial"];
                        $model->idScreenMaterial = $records["idScreenMaterial"];
                        $model->idGlass = $records["idGlass"];
                        $model->idCPU = $records["idCPU"];
                        $model->idModelBrand = $records["idModelBrand"];
                        $model->STATUS = $records["STATUS"];
                        $model->Available = $records["Available"];

                        $model->save();

                        $json = array(

                            "status" => 200,
                            "message" => "Records saved"

                        );

                        break;
                    }
                } else {
                    $json = array(

                        "status" => 404,
                        "message" => "Records must not be empty"

                    );
                }
            } else {
                $json = array(
                    "status" => 404,
                    "message" => "Your credentials did not match"
                );
            }
        }
        return json_encode($json, true);
    }

    public function update(Request $request)
    {
        $token = $request->header('Authorization');
        $users = User::select("*")->get();
        $json = array();

        foreach ($users as $key => $user) {
            if ("Basic " . base64_encode($user["PASSWORD"] . ":" . $user["remember_token"]) == $token) {
                $updates = array(
                    "idModel" => $request->input("id"),
                    "Serie" => $request->input("serie"),
                    "YEAR" => $request->input("year"),
                    "ScreenSize" => $request->input("screensize"),
                    "PixelDensity" => $request->input("pixeldensity"),
                    "BatteryPower" => $request->input("batterypower"),
                    "RAM" => $request->input("ram"),
                    "ResolutionX" => $request->input("resolutionx"),
                    "ResolutionY" => $request->input("resolutiony"),
                    "FrontMainCamera" => $request->input("frontmaincamera"),
                    "BackMainCamera" => $request->input("backmaincamera"),
                    "Weight" => $request->input("weight"),
                    "Waterproof" => $request->input("waterproof"),
                    "RefreshRate" => $request->input("refreshrate"),
                    "idOS" => $request->input("idos"),
                    "idModelMaterial" => $request->input("idmodelmaterial"),
                    "idScreenMaterial" => $request->input("idscreenmaterial"),
                    "idGlass" => $request->input("idglass"),
                    "idCPU" => $request->input("idcpu"),
                    "idModelBrand" => $request->input("idmodelbrand"),
                    "STATUS" => "Active",
                    "Available" => 1
                );

                if (!empty($updates)) {
                    $validator = Validator::make(
                        $updates,
                        [
                            'idModel' => 'required|integer|exists:Model',
                            'Serie' => 'required|string|unique:Model',
                            'YEAR' => 'required|string',
                            'ScreenSize' => 'required|numeric',
                            'PixelDensity' => 'required|numeric',
                            'BatteryPower' => 'required|integer',
                            'RAM' => 'required|integer',
                            'ResolutionX' => 'required|integer',
                            'ResolutionY' => 'required|integer',
                            'FrontMainCamera' => 'required|integer',
                            'BackMainCamera' => 'required|integer',
                            'Weight' => 'required|integer',
                            'Waterproof' => 'required|integer',
                            'RefreshRate' => 'required|integer',
                            'idOS' => 'required|integer|exists:OS,idOS',
                            'idModelMaterial' => 'required|integer|exists:ModelMaterial,idModelMaterial',
                            'idScreenMaterial' => 'required|integer|exists:ScreenMaterial,idScreenMaterial',
                            'idGlass' => 'required|integer|exists:Glass,idGlass',
                            'idCPU' => 'required|integer|exists:CPU,idCPU',
                            'idModelBrand' => 'required|integer|exists:ModelBrand,idModelBrand',
                            'STATUS' => 'required|string',
                            'Available' => 'required'
                        ]
                    );

                    if ($validator->fails()) {
                        $errors = $validator->errors();

                        $json = array(
                            "status" => 404,
                            "error" => $errors
                        );

                        return json_encode($json, true);
                    } else {
                        $values = array(
                            "idModel" => $updates["idModel"],
                            "Serie" => $updates["Serie"],
                            "YEAR" => $updates["YEAR"],
                            "ScreenSize" => $updates["ScreenSize"],
                            "PixelDensity" => $updates["PixelDensity"],
                            "BatteryPower" => $updates["BatteryPower"],
                            "RAM" => $updates["RAM"],
                            "ResolutionX" => $updates["ResolutionX"],
                            "ResolutionY" => $updates["ResolutionY"],
                            "FrontMainCamera" => $updates["FrontMainCamera"],
                            "BackMainCamera" => $updates["BackMainCamera"],
                            "Weight" => $updates["Weight"],
                            "Waterproof" => $updates["Waterproof"],
                            "RefreshRate" => $updates["RefreshRate"],
                            "idOS" => $updates["idOS"],
                            "idModelMaterial" => $updates["idModelMaterial"],
                            "idScreenMaterial" => $updates["idScreenMaterial"],
                            "idGlass" => $updates["idGlass"],
                            "idCPU" => $updates["idCPU"],
                            "idModelBrand" => $updates["idModelBrand"],
                            "STATUS" => $updates["STATUS"],
                            "Available" => $updates["Available"],
                        );
                        Models::where("idModel", $updates["idModel"])->update($values);

                        $json = array(

                            "status" => 200,
                            "message" => "Records updated"

                        );

                        break;
                    }
                } else {
                    $json = array(

                        "status" => 404,
                        "message" => "Records must not be empty"

                    );
                }
            } else {
                $json = array(
                    "status" => 404,
                    "message" => "Your credentials did not match"
                );
            }
        }
        return json_encode($json, true);
    }

    public function delete(Request $request)
    {
        $token = $request->header('Authorization');
        $users = User::select("*")->get();
        $json = array();

        foreach ($users as $key => $user) {
            if ("Basic " . base64_encode($user["PASSWORD"] . ":" . $user["remember_token"]) == $token) {
                $delets = array(
                    "idModel" => $request->input("id"),
                    "available" => 0
                );

                if (!empty($delets)) {
                    $validator = Validator::make(
                        $delets,
                        [
                            'idModel' => 'required|int|exists:Model'
                        ]
                    );

                    if ($validator->fails()) {
                        $errors = $validator->errors();

                        $json = array(
                            "status" => 404,
                            "error" => $errors
                        );

                        return json_encode($json, true);
                    } else {
                        $values = array("Available" => $delets["available"]);
                        Models::where("idModel", $delets["idModel"])->update($values);

                        $json = array(

                            "status" => 200,
                            "message" => "Record deleted"

                        );

                        break;
                    }
                } else {
                    $json = array(

                        "status" => 404,
                        "message" => "Records must not be empty"

                    );
                }
            } else {
                $json = array(
                    "status" => 404,
                    "message" => "Your credentials did not match"
                );
            }
        }
        return json_encode($json, true);
    }
}

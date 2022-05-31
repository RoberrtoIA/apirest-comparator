<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CPU;
use App\Models\User;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CPUController extends Controller
{
    public function index()
    {
        $CPU = DB::table('CPU')->select('idCPU', 'CPUModel', 'Score', 'Speed', 'idCPUBrand')->where("Available", 1)->get();
        $json = array(

            "status" => 200,
            "records" => count($CPU),
            "details" => $CPU

        );
        return json_encode($json, true);
    }

    public function show($id)
    {
        if (!empty(CPU::where("idCPU", $id)->get()) && count(CPU::where("idCPU", $id)->get()) > 0) {
            $json = array(

                "status" => 200,
                "details" => CPU::where("idCPU", $id)->get()

            );

            return json_encode($json, true);
        } else {
            $json = array(

                "status" => 404,
                "details" => 'That CPU is not registered'

            );

            return json_encode($json, true);
        }
    }

    public function store(Request $request)
    {
        $token = $request->header('Authorization');
        $users = Users::select("*")->get();
        $json = array();

        foreach ($users as $key => $user) {
            if ("Basic " . base64_encode($user["PASSWORD"] . ":" . $user["remember_token"]) == $token) {
                $id = null;
                foreach (CPU::select('idCPU')->orderBy('idCPU', 'desc')->first()->get() as $key => $value) {
                    $id = $value;
                }

                $records = array(
                    "idCPU" => ($id['idCPU'] + 1),
                    "CPUModel" => $request->input("cpu"),
                    "Score" => $request->input("score"),
                    "Speed" => $request->input("speed"),
                    "idCPUBrand" => $request->input("idcpubrand"),
                    "Available" => 1
                );

                if (!empty($records)) {
                    $validator = Validator::make(
                        $records,
                        [
                            'idCPU' => 'required|integer',
                            'CPUModel' => 'required|string|unique:CPU',
                            'Score' => 'required|numeric',
                            'Speed' => 'required|numeric',
                            'idCPUBrand' => 'required|int|exists:CPUBrand,idCPUBrand',
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
                        $cpu = new CPU();
                        $cpu->idCPU = $records["idCPU"];
                        $cpu->CPUModel = $records["CPUModel"];
                        $cpu->Score = $records["Score"];
                        $cpu->Speed = $records["Speed"];
                        $cpu->idCPUBrand = $records["idCPUBrand"];
                        $cpu->Available = $records["Available"];

                        $cpu->save();

                        $json = array(

                            "status" => 200,
                            "message" => "Records saved"

                        );
                        break;

                        // return json_encode($json, true);
                    }
                } else {
                    $json = array(

                        "status" => 404,
                        "message" => "Records must not be empty"

                    );

                    return json_encode($json, true);
                }
            } else {
                $json = array(

                    "status" => 404,
                    // "message" => $token,
                    // "id" => $user["PASSWORD"],
                    // "remember" => $user["remember_token"],
                    // "encode" => "Basic ".base64_encode($user["PASSWORD"].":".$user["remember_token"]),
                    // "encode" => "Basic ".base64_encode($user["remember_token"].":".$user["PASSWORD"]),
                    // "NO encode" => $user["remember_token"].":".$user["PASSWORD"],
                    // "error" => var_dump($users)
                    // "id + remember" => $user["remember_token"]
                    // "message" => $user["remember_token"]
                    "message" => "Your credentials did not match"

                );

                // $2y$10$Awy96.mJlFZZAg1G/EPLdOPS7e8K0aLkgixWXRzDCgQsDYi9Y7zWi
                // JDJ5JDEwJEptSy9HZFhoeUdnbk1CT2RoUTRUbi5yMFlJNGxnc2gvRTdCNzdSTDc3NG50MmZPb3U5MkltOiQyeSQxMCQ3Ry9hdTBWektLekhOb09ZZkp6SmEuU25OQXlNOVlJaHFqSE1WbUdib2xFbkI4S1hheHN5YQ==

                // return json_encode($json, true);
            }
        }
        return json_encode($json, true);
    }

    public function update(Request $request)
    {
        $token = $request->header('Authorization');
        $users = Users::select("*")->get();
        $json = array();

        foreach ($users as $key => $user) {
            if ("Basic " . base64_encode($user["PASSWORD"] . ":" . $user["remember_token"]) == $token) {
                $updates = array(
                    "idCPU" => $request->input("id"),
                    "CPUModel" => $request->input("cpu"),
                    "Score" => $request->input("score"),
                    "Speed" => $request->input("speed"),
                    "idCPUBrand" => $request->input("idcpubrand"),
                );

                if (!empty($updates)) {
                    $validator = Validator::make(
                        $updates,
                        [
                            'idCPU' => 'required|int|exists:CPU',
                            'CPUModel' => 'required|string|max:255|unique:CPU',
                            'Score' => 'required|numeric',
                            'Speed' => 'required|numeric',
                            'idCPUBrand' => 'required|int|exists:CPUBrand,idCPUBrand'
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
                            "idCPU" => $updates["idCPU"],
                            "CPUModel" => $updates["CPUModel"],
                            "Score" => $updates["Score"],
                            "Speed" => $updates["Speed"],
                            "idCPUBrand" => $updates["idCPUBrand"],
                        );
                        CPU::where("idCPU", $updates["idCPU"])->update($values);

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
        $users = Users::select("*")->get();
        $json = array();

        foreach ($users as $key => $user) {
            if ("Basic " . base64_encode($user["PASSWORD"] . ":" . $user["remember_token"]) == $token) {
                $delets = array(
                    "idCPU" => $request->input("id"),
                    "available" => 0
                );

                if (!empty($delets)) {
                    $validator = Validator::make(
                        $delets,
                        [
                            'idCPU' => 'required|int|exists:CPU'
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
                        CPU::where("idCPU", $delets["idCPU"])->update($values);

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

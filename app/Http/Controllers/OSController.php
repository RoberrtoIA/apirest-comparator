<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OS;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OSController extends Controller
{
    public function index()
    {
        $OS = DB::table('OS')->select('idOS', 'OS', 'OSVersion', 'Score')->where("Available", 1)->get();
        $json = array(

            "status" => 200,
            "records" => count($OS),
            "details" => $OS

        );
        return json_encode($json, true);
    }

    public function show($id)
    {
        if (!empty(OS::where("idOS", $id)->get()) && count(OS::where("idOS", $id)->get()) > 0) {
            $json = array(

                "status" => 200,
                "details" => OS::where("idOS", $id)->get()

            );

            return json_encode($json, true);
        } else {
            $json = array(

                "status" => 404,
                "details" => 'That Brand is not registered'

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
                foreach (OS::select('idOS')->orderBy('idOS', 'desc')->first()->get() as $key => $value) {
                    $id = $value;
                }
                $json = array();
                $records = array(
                    "idOS" => ($id['idOS'] + 1),
                    "OS" => $request->input("os"),
                    "OSVersion" => $request->input("osversion"),
                    "Score" => $request->input("score"),
                    "Available" => 1
                );

                if (!empty($records)) {
                    $validator = Validator::make(
                        $records,
                        [
                            'idOS' => 'required',
                            'OS' => 'required|string',
                            'OSVersion' => 'required|string|max:255',
                            'Score' => 'required|int',
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
                        $os = new OS();
                        $os->idOS = $records["idOS"];
                        $os->OS = $records["OS"];
                        $os->OSVersion = $records["OSVersion"];
                        $os->Score = $records["Score"];
                        $os->Available = $records["Available"];

                        $os->save();

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
                    "OS" => $request->input("os"),
                    "OSVersion" => $request->input("osversion"),
                    "Score" => $request->input("score"),
                    "idOS" => $request->input("id")
                );

                if (!empty($updates)) {
                    $validator = Validator::make(
                        $updates,
                        [
                            'OS' => 'required|string|max:255',
                            'OSVersion' => 'required|string',
                            'Score' => 'required|int',
                            'idOS' => 'required|int|exists:OS'
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
                            "OS" => $updates["OS"],
                            "OSVersion" => $updates["OSVersion"],
                            "Score" => $updates["Score"],
                            "idOS" => $updates["idOS"]
                        );
                        OS::where("idOS", $updates["idOS"])->update($values);

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
                    "idOS" => $request->input("id"),
                    "available" => 0
                );

                if (!empty($delets)) {
                    $validator = Validator::make(
                        $delets,
                        [
                            'idOS' => 'required|int|exists:OS'
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
                        OS::where("idOS", $delets["idOS"])->update($values);

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

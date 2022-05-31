<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Glass;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class GlassController extends Controller
{
    public function index()
    {
        $Glass = DB::table('Glass')->select('idGlass', 'Glass', 'Score')->where("available", 1)->get();
        $json = array(

            "status" => 200,
            "records" => count($Glass),
            "details" => $Glass

        );
        return json_encode($json, true);
    }

    public function show($id)
    {
        if (!empty(Glass::where("idGlass", $id)->get()) && count(Glass::where("idGlass", $id)->get()) > 0) {
            $json = array(

                "status" => 200,
                "details" => Glass::where("idGlass", $id)->get()

            );

            return json_encode($json, true);
        } else {
            $json = array(

                "status" => 404,
                "details" => 'That Glass is not registered'

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
                foreach (Glass::select('idGlass')->orderBy('idGlass', 'desc')->first()->get() as $key => $value) {
                    $id = $value;
                }
                $json = array();
                $records = array(
                    "idGlass" => ($id['idGlass'] + 1),
                    "Glass" => $request->input("glass"),
                    "Score" => $request->input("score"),
                    "available" => 1
                );

                if (!empty($records)) {
                    $validator = Validator::make(
                        $records,
                        [
                            'idGlass' => 'required',
                            'Glass' => 'required|string|max:255|unique:glass',
                            'Score' => 'required|int|unique:glass',
                            'available' => 'required'
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
                        $glass = new Glass();
                        $glass->idGlass = $records["idGlass"];
                        $glass->Glass = $records["Glass"];
                        $glass->Score = $records["Score"];
                        $glass->available = $records["available"];

                        $glass->save();

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
                    "Glass" => $request->input("glass"),
                    "Score" => $request->input("score"),
                    "idGlass" => $request->input("id")
                );

                if (!empty($updates)) {
                    $validator = Validator::make(
                        $updates,
                        [
                            'Glass' => 'required|string|max:255|unique:glass',
                            'Score' => 'required|int',
                            'idGlass' => 'required|int|exists:Glass'
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
                        $values = array("Glass" => $updates["Glass"], "Score" => $updates["Score"]);
                        Glass::where("idGlass", $updates["idGlass"])->update($values);

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
                    "idGlass" => $request->input("id"),
                    "available" => 0
                );

                if (!empty($delets)) {
                    $validator = Validator::make(
                        $delets,
                        [
                            'idGlass' => 'required|int|exists:Glass'
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
                        $values = array("available" => $delets["available"]);
                        Glass::where("idGlass", $delets["idGlass"])->update($values);

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

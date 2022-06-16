<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelBrand;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ModelBrandController extends Controller
{
    public function index()
    {
        $ModelBrand = DB::table('ModelBrand')->select('idModelBrand', 'Brand')->where("Available", 1)->get();
        $json = array(

            "status" => 200,
            "records" => count($ModelBrand),
            "details" => $ModelBrand

        );
        return json_encode($json, true);
    }

    public function show($id)
    {
        if (!empty(ModelBrand::where("idModelBrand", $id)->get()) && count(ModelBrand::where("idModelBrand", $id)->get()) > 0) {
            $json = array(

                "status" => 200,
                "details" => ModelBrand::where("idModelBrand", $id)->get()

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

        $id = null;
        foreach (ModelBrand::select('idModelBrand')->orderBy('idModelBrand', 'desc')->first()->get() as $key => $value) {
            $id = $value;
        }
        $json = array();
        $records = array(
            "idModelBrand" => ($id['idModelBrand'] + 1),
            "Brand" => $request->input("brand"),
            "Available" => 1
        );

        if (!empty($records)) {
            $validator = Validator::make(
                $records,
                [
                    'idModelBrand' => 'required|integer',
                    'Brand' => 'required|string|unique:ModelBrand',
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
                $modelBrand = new ModelBrand();
                $modelBrand->idModelBrand = $records["idModelBrand"];
                $modelBrand->Brand = $records["Brand"];
                $modelBrand->Available = $records["Available"];

                $modelBrand->save();

                $json = array(

                    "status" => 200,
                    "message" => "Records saved"

                );
            }
        } else {
            $json = array(

                "status" => 404,
                "message" => "Records must not be empty"

            );
        }
        // return json_encode($json, true);
        $modelbrand = DB::table('modelbrand')->select('idModelBrand', 'Brand', 'Available')->get();
        return view('pages.brand', ['modelbrand' => ($modelbrand)]);
    }

    public function update(Request $request)
    {
        $token = $request->header('Authorization');
        $users = User::select("*")->get();
        $json = array();

        $updates = array(
            "Brand" => $request->input("brand"),
            "Available" => $request->input("available"),
            "idModelBrand" => $request->input("id")
        );

        if (!empty($updates)) {
            $validator = Validator::make(
                $updates,
                [
                    'Brand' => 'required|string|max:255',
                    "Available" => 'required|numeric',
                    'idModelBrand' => 'required|int|exists:ModelBrand'
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
                    "Brand" => $updates["Brand"],
                    "Available" => $updates["Available"],
                    "idModelBrand" => $updates["idModelBrand"]
                );
                ModelBrand::where("idModelBrand", $updates["idModelBrand"])->update($values);

                $json = array(

                    "status" => 200,
                    "message" => "Records updated"

                );
            }
        } else {
            $json = array(

                "status" => 404,
                "message" => "Records must not be empty"

            );
        }
        // return json_encode($json, true);
        $modelbrand = DB::table('modelbrand')->select('idModelBrand', 'Brand', 'Available')->get();
        return view('pages.brand', ['modelbrand' => ($modelbrand)]);
    }

    public function delete(Request $request)
    {
        $token = $request->header('Authorization');
        $users = User::select("*")->get();
        $json = array();

        $delets = array(
            "idModelBrand" => $request->input("id"),
            "available" => 0
        );

        if (!empty($delets)) {
            $validator = Validator::make(
                $delets,
                [
                    'idModelBrand' => 'required|int|exists:ModelBrand'
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
                ModelBrand::where("idModelBrand", $delets["idModelBrand"])->update($values);

                $json = array(

                    "status" => 200,
                    "message" => "Record deleted"

                );
            }
        } else {
            $json = array(

                "status" => 404,
                "message" => "Records must not be empty"

            );
        }
        // return json_encode($json, true);
        $modelbrand = DB::table('modelbrand')->select('idModelBrand', 'Brand', 'Available')->get();
        return view('pages.brand', ['modelbrand' => ($modelbrand)]);
    }
}

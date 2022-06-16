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
                $cpubrand = DB::table('cpubrand')->select('*')->get();
                $cpu = DB::table('CPU')->select('CPU.idCPU', 'CPU.CPUModel', 'CPU.Score', 'CPU.Speed', 'CPUBrand.CPUBrand', 'CPU.Available')->join('CPUBrand', 'CPU.idCPUBrand', '=', 'CPUBrand.idCPUBrand')->get();
                return view('pages.cpu', ['cpu' => ($cpu), 'cpubrand' => ($cpubrand)]);

                // return json_encode($json, true);
            }
        } else {
            $json = array(

                "status" => 404,
                "message" => "Records must not be empty"

            );

            // return json_encode($json, true);
        }
        return json_encode($json, true);
    }

    public function update(Request $request)
    {
        $token = $request->header('Authorization');
        $users = Users::select("*")->get();
        $json = array();

        $updates = array(
            "idCPU" => $request->input("id"),
            "CPUModel" => $request->input("cpu"),
            "Score" => $request->input("score"),
            "Speed" => $request->input("speed"),
            "Available" => $request->input("available"),
            "idCPUBrand" => $request->input("idcpubrand"),
        );

        if (!empty($updates)) {
            $validator = Validator::make(
                $updates,
                [
                    'idCPU' => 'required|int|exists:CPU',
                    'CPUModel' => 'required|string|max:255',
                    'Score' => 'required|numeric',
                    'Speed' => 'required|numeric',
                    "Available" => 'required|numeric',
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
                    "Available" => $updates["Available"],
                    "idCPUBrand" => $updates["idCPUBrand"],
                );
                CPU::where("idCPU", $updates["idCPU"])->update($values);

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
        $cpubrand = DB::table('cpubrand')->select('*')->get();
        $cpu = DB::table('CPU')->select('CPU.idCPU', 'CPU.CPUModel', 'CPU.Score', 'CPU.Speed', 'CPUBrand.CPUBrand', 'CPU.Available')->join('CPUBrand', 'CPU.idCPUBrand', '=', 'CPUBrand.idCPUBrand')->get();
        return view('pages.cpu', ['cpu' => ($cpu), 'cpubrand' => ($cpubrand)]);
        // return json_encode($json, true);
    }

    public function delete(Request $request)
    {
        $token = $request->header('Authorization');
        $users = Users::select("*")->get();
        $json = array();

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
            }
        } else {
            $json = array(

                "status" => 404,
                "message" => "Records must not be empty"

            );
        }
        $cpu = DB::table('CPU')->select('CPU.idCPU', 'CPU.CPUModel', 'CPU.Score', 'CPU.Speed', 'CPU.idCPUBrand', 'CPU.Available')->get();
        return view('pages.cpu', array('cpu' => $cpu));
        // return json_encode($json, true);
    }
}

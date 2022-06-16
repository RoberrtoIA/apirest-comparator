<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    public function index()
    {
        // $json = array(
        //     "message" => "None"
        // );
        // echo json_encode($json, true);

        $CPU = DB::table('Users')->select('*')->get();
        $json = array(

            "status" => 200,
            "records" => count($CPU),
            "users" => $CPU

        );
        return json_encode($json, true);
    }

    public function store(Request $request)
    {
        $id = null;
        foreach (Users::select('idUsers')->orderBy('idUsers', 'desc')->first()->get() as $key => $value) {
            $id = $value;
        }
        $records = array(
            "idUsers" => ($id["idUsers"] + 1),
            "name" => $request->input("name"),
            "email" => $request->input("email"),
            "password" => $request->input("password")
        );

        if (!empty($records)) {

            $validator = Validator::make($records, [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|max:255'

            ]);

            if ($validator->fails()) {

                $errors = $validator->errors();

                $json = array(

                    "status" => 404,
                    "detalle" => $errors
                );

                return json_encode($json, true);
            } else {

                $token = Hash::make($records["name"] . $records["email"]);
                $password = Hash::make($records["password"]);

                $user = new Users();
                $user->idUsers = $records["idUsers"];
                $user->name = $records["name"];
                $user->email = $records["email"];
                $user->password = $password;
                $user->remember_token = $token;

                $user->save();

                $json = array(

                    "status" => 200,
                    "message" => "User recorded, save your secret key",
                    "secret key" => $token,
                    "hashed password" => $password

                );

                return json_encode($json, true);
            }
        } else {

            $json = array(

                "status" => 404,
                "detalle" => "Invalid inputs"
            );

            return json_encode($json, true);
        }
    }
}

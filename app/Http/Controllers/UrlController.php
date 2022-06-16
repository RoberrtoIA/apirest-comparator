<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UrlController extends Controller
{
    public function redirect()
    {
        $smartphones = DB::table('Smartphones')->select('Smartphone')->where("Available", 1)->get();
        return view("welcome", array("smartphones"=>$smartphones));
    }
}

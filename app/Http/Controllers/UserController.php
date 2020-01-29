<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    private function respJson($success, $message, $data = "")
    {
        if($success)
        {
            return response()->json([
                "message"=>$message,
                "success"=>$success,
                "data"=>$data
            ], 200);
        }
        else
        {
            return response()->json([
                "message"=>$message,
                "success"=>$success,
                "data"=>$data
            ], 404);
        }
    }

    public function allUser()
    {
        $msg = "";

        try 
        {
            $User = User::all();
            if($User->isEmpty()) $msg = defaultEmptyMsg;
            else $msg = defaultSuccessMsg;

            return $this->respJson(true, $msg, $User);
        } 
        catch (\Throwable $err)
        {
            $msg = $err;
            return $this->respJson(false, $msg);
        }
    }

    //
}

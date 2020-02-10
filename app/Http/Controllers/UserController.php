<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

    public function allUser()
    {
        $msg = "";

        try 
        {
            $User = User::all();
            if($User->isEmpty()) $msg = defaultEmptyMsg;
            else $msg = defaultSuccessMsg;

            return respJson(true, $msg, $User);
        } 
        catch (\Throwable $err)
        {
            throw $err;
        }
    }

    public function insertUser(Request $request)
    {
        $model = $request->all();
        try 
        {
            // dd($model);
            $model['api_token'] = base64_encode($model['nomor_pegawai'].$model['username']);
            $model['userpassword'] = Hash::make($model['Userpassword']);

            $User = User::create($model);

            if($User) return respJson(true, defaultInsertSuccessMsg, $User);
            else return respJson(false, "Failed Insert");
        } 
        catch (\Throwable $th) 
        {
            throw $th;
        }
    }

    public function updateUser(Request $request)
    {
        $req = $request->all();
        try {
            
            $this->validate($request, [
                'userid'=>'required',
                'nomor_pegawai'=>'required|max:10',
                'username'=>'required|max:20'
            ]);

            $User = User::find($req['userid']);
            $User->nomor_pegawai = $req['nomor_pegawai'];
            $User->username = $req['username'];

            if($User->save()) return respJson(true, defaultUpdateSuccessMsg, $User);
            else return respJson(false, "Failed Update");


        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function deleteUser(Request $request)
    {
        $userid = "";
        try {
            
            $this->validate($request, ['userid'=>'required']);
            $userid = $request->input('userid');

            $User = User::find($userid);

            if($User->delete()) return respJson(true, defaultUpdateSuccessMsg);
            else return respJson(false, "fail Delete Data");

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    //
}

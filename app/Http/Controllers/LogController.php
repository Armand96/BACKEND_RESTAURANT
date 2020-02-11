<?php

namespace App\Http\Controllers;

use App\Logs;
use Illuminate\Http\Request;

class LogController extends Controller
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


    public function allLogs()
    {
        try {

            $Logs = Logs::all();
            if($Logs->isEmpty()) return respJson(false, defaultEmptyMsg, $Logs);
            else return respJson(true, defaultSuccessMsg, $Logs);


        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function insertLogs(Request $request)
    {
        $model = $request->all();
        try {

            $this->validate($request, [
                'action_type'=>'required',
                'table'=>'required',
                'old_value'=>'required',
                'new_value'=>'required'
            ]);
            
            $Logs = Logs::create($model);
            if($Logs) return respJson(true, defaultInsertSuccessMsg, $Logs);
            else return respJson(false, "Failed Insert");

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    //
}

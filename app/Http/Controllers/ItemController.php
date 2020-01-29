<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Items;

class ItemController extends Controller
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

    // general function to return json
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


    public function allItem()
    {
        $msg = "";

        try 
        {
            $Items = Items::all();
            if($Items->isEmpty()) $msg = defaultEmptyMsg;
            else $msg = defaultSuccessMsg;

            return respJson(true, $msg, $Items);
        } 
        catch (\Throwable $err)
        {
            $msg = $err;
            return respJson(false, $msg);
        }
    }


    public function itemByMenu(Request $request)
    {
        $msg = "";

        try 
        {
            $Items = Items::where('menu_id', '=', $request->input('menu_id'));
            if($Items->isEmpty()) $msg = defaultEmptyMsg;
            else $msg = defaultSuccessMsg;

            return respJson(true, $msg, $Items);
        } 
        catch (\Throwable $err)
        {
            $msg = $err;
            return respJson(false, $msg);
        }
    }

    // BELOM KELARR
    public function insertItem(Request $request)
    {
        $msg = "";
        $img = "";

        try {

            // ----- Check if request has foto or not
            if ($request->hasFile('item_img_name')){
                // dd($request->file('foto'));
                $extname = '.'.$request->file('item_img_name')->getClientOriginalExtension();
                $img = str_replace(' ', '_', $request->input('nama_item')).$extname;
                $request->file('item_img_name')->move(storage_path('item_image'), $img);
            }
    
            $Items = new Items();
            $Items = $request->all();

            return respJson(true, defaultInsertSuccessMsg, $Items);

        } catch (\Throwable $err) {
            $msg = $err;
            return respJson(false, $msg);
        }
    }

}

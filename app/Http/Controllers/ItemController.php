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
            throw $err;
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
            throw $err;
        }
    }

    // INSERT NEW ITEM
    public function insertItem(Request $request)
    {
        $img = "";
        $itemname = "";

        try {

            $this->validate($request, [
                'item_name'=>'required|max:50',
            ]);

            $itemname = $request->input('item_name');            
            // ----- Check if request has foto or not
            if ($request->hasFile('item_img_name')){
                $extname = '.'.$request->file('item_img_name')->getClientOriginalExtension();
                $img = str_replace(' ', '_', $itemname).$extname;
                $request->file('item_img_name')->move(storage_path('item_image'), $img);
            }
    
            $Items = $request->all();
            $Items['item_img_name'] = $img;
            $Items = Items::create($Items); 
            
            if($Items) return respJson(true, defaultInsertSuccessMsg, $Items);
            else return respJson(false, "Failed Insert");

        } catch (\Throwable $err) {
            throw $err;
        }
    }

    // UPDATE ITEM
    public function updateItems(Request $request)
    {
        $img = "";
        $itemname = "";
        $itemid = "";
        $req = $request->all();
        // dd($req);
        try {

            $this->validate($request, [
                'item_id'=>'required',
                'item_name'=>'required|max:50'
            ]);
            
            $itemid = $req['item_id'];
            $itemname = $req['item_name']; 
            $Items = Items::find($itemid);

            if($Items->item_img_name != "")
            {
                $imgpath = IMG_STORAGE_PATH.$Items->item_img_name;

                if(file_exists($imgpath))
                {
                    unlink($imgpath);
                }
            }

            // ----- Check if request has foto or not
            if ($request->hasFile('item_img_name')){
                $extname = '.'.$request->file('item_img_name')->getClientOriginalExtension();
                $img = str_replace(' ', '_', $itemname).$extname;
                $request->file('item_img_name')->move(storage_path('item_image'), $img);
            } else $img = "";

            $Items->item_img_name = $img;
            $Items->item_name = $itemname;
            $Items->menu_id = isset($req['menu_id']) ? $req['menu_id'] : "";
            $Items->price = isset($req['price']) ? $req['price'] : 0;
            $Items->show = isset($req['show']) ? $req['show'] : true;
            $Items->out_of_stock = isset($req['out_of_stock']) ? $req['out_of_stock'] : false;
            // dd($Items);
            
            if($Items->save()) return respJson(true, defaultInsertSuccessMsg, $Items);
            else return respJson(false, "Failed Insert");

        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function checkFileExists()
    {
        if(file_exists(storage_path('item_image').'/rendang.jpg'))
        {
            // dd(storage_path('item_image'));
            dd('yes');
        }
        else
        {
            // dd(storage_path('item_image'));
            dd('no');
        }
    }

}

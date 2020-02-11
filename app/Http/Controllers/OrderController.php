<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order_Today;

class OrderController extends Controller
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

    public function insertOrderToday(Request $request)
    {
        /*
            The Parameter Items should be like this
            It is an array of object
            items = [
                {
                    menu_id:"1"
                    item_id:"1"
                }
            ]
        */

        $this->validate($request, ['items'=>'required']);
        $itemArray = $request->input('items');

        if(is_array($itemArray)) return respJson(false, "The Parameter is not an array", $itemArray);

        try {
            
            $OrderSaved = array();

            foreach ($itemArray as $index => $Items) {
                
                $Order = Order_Today::create($Items);
                array_push($OrderSaved, $Order);

            }    
            
            if(count($OrderSaved) > 0) return respJson(true, defaultInsertSuccessMsg, $OrderSaved);
            else return respJson(false, "Failed Insert");

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    //
}

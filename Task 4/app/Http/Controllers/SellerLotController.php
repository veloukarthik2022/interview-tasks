<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LotRequest;
use App\Models\Lots;
use App\Models\BidsLot;
use App\Models\BidResult;
use Illuminate\Support\Facades\DB;

class SellerLotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $lots = Lots::all();

        if(count($lots)>0)
        {
            return response()->json(["status"=>"success","data"=>$lots]);
        }
        else
        {
            return response()->json(["status"=>"failed","message"=>"lots data not found"]);
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LotRequest $request)
    {
        //
        $lots = Lots::create($request->toArray());

        if($lots)
        {
            return response()->json(["status"=>"success","message"=>"Your lots saved successfully"]);
        }
        else
        {
            return response()->json(["status"=>"failed","message"=>"Your lots not saved successfully"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $lots = Lots::where("id",$id)->update($request->toArray());

        if($lots)
        {
            return response()->json(["status"=>"success","message"=>"Your lots update successfully"]);
        }
        else
        {
            return response()->json(["status"=>"failed","message"=>"Your lots not found"]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

     public function bidResult($id)
     {
        $bidResult = BidsLot::where("lot_id",$id)->orderByDesc("price")->first();

        if($bidResult)
        {
            return response()->json(["status"=>"success","data"=>$bidResult]);
        }
        return response()->json(["status"=>"error","message"=>"No bids found for this lots"]);
     }
    
    public function destroy($id)
    {
        //

        $lots = Lots::where("id",$id)->first();
        
        if($lots)
        {
            $lots->delete();
            return response()->json(["status"=>"success","message"=>"Lots deleted successfully"]);
        }
        else
        {
            return response()->json(["status"=>"failed","message"=>"lots data not found"]);
        }
    }
    
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BidsLot;
use App\Http\Requests\StoreCustomerBidRequest;
use App\Models\Lots;

class CustomerBidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $bidlots = BidsLot::with("lotsDetail")->get();

        return response()->json(["status" => "success", "data" => $bidlots]);
    }

    public function lotsBid($id)
    {
        $bidlots = BidsLot::with("lotsDetail")->where("lot_id",$id)->get();

        if(count($bidlots)>0)
        {
            return response()->json(["status" => "success", "data" => $bidlots]);
        }
        return response()->json(["status" => "success", "message" => "No bids found for this lots"]);

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
    public function store(Request $request)
    {
        //
        $lotsCheck = Lots::where("id",$request->lot_id)->first();
        if($lotsCheck)
        {
            // return $request;

            $bidsCheck = BidsLot::where("lot_id",$request->lot_id)->where("customer",$request->customer)->first();

            if($bidsCheck)
            {
                return response()->json(["status"=>"success","message"=>"Your bid already saved"],201); 
            }

            $bidLots = BidsLot::create($request->toArray());

            return response()->json(["status"=>"success","message"=>"Your bid saved successfully"],200); 

        }
        else
        {
            return response()->json(["status"=>"failed","message"=>"No lots found for this bid"],400);
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
        $lotsCheck = Lots::where("id",$request->lot_id)->first();
        if($lotsCheck)
        {
            // return $request;

            $bidsCheck = BidsLot::where("lot_id",$request->lot_id)->first();

            if($bidsCheck)
            {
                $bidLots = $bidsCheck->update($request->toArray());

                return response()->json(["status"=>"success","message"=>"Your bid updated successfully"],200); 
            }

           

        }
        else
        {
            return response()->json(["status"=>"failed","message"=>"No lots found for this bid"],400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $bidsCheck = BidsLot::where("id",$id)->first();

        if($bidsCheck)
        {
            if($bidsCheck->delete())
            {
                return response()->json(["status"=>"success","message"=>"Your bid deleted successfully"],200); 
            }
            
        }
        else
        {
            return response()->json(["status"=>"failed","message"=>"No bids data found"],400);
        }
    }

}

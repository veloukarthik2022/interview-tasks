<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->limit ? $request->limit : 5;

        $user = User::paginate($limit);

        return response()->json(["data" => $user], 200);
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
        $users = Http::get("https://randomuser.me/api/?results=50");
        $data = $users->json();

        $userdata = [];
        // return $data['results'][0];
        foreach ($data['results'] as $user) {
            $location = [
                "street" => $user["location"]['street'],
                "country" => $user["location"]["country"],
                "state" => $user["location"]["state"],
                "city" => $user["location"]["city"],
                "postcode" => $user["location"]["postcode"]
            ];
            $userdata = array(
                "gender" => $user['gender'],
                "name" => json_encode($user["name"], JSON_UNESCAPED_SLASHES),
                "location" => json_encode($location, JSON_UNESCAPED_SLASHES),
                "email" => $user["email"],
                "phone" => $user["phone"],
                "picture" => $user["picture"]['large']
            );
            User::create($userdata);
        }

        // return $userdata;

        // User::create($userdata);

        return  response()->json(["status"=>"success","message" => "Data saved successfully"], 200);
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
        $user = User::find($id);

        return response()->json(["data" => $user], 200);
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

        // dd($request);

        // return $request;

        $name = json_decode(json_encode($request->name, JSON_UNESCAPED_SLASHES));

        $location = json_decode(json_encode($request->location, JSON_UNESCAPED_SLASHES));

        // return $location;


        $userCheck = User::where("id", $id)->first();

        if ($userCheck) {
            $userdata = array(
                "gender" => $request->gender,
                "name" => $name,
                "location" =>$location,
                "email" => $request->email,
                "phone" => $request->phone,
                "picture" => $request->picture
            );
            // return $userdata;
            $userCheck->update($userdata);
            return response()->json(["status"=>"success","message" => "User update successfully"], 200);
        }
        return response()->json(["status"=>"failed","error" => "User not found"], 201);
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
        $userCheck = User::where("id", $id)->first();

        if ($userCheck) {
            $userCheck->delete();
            return response()->json(["status"=>"success","message" => "User Deleted Successfully"], 200);
        }
        return response()->json(["status"=>"failed","error" => "User not found"], 201);
    }

    public function export()
    {
        return Excel::download(new UsersExport, time() . '.xlsx');
    }
}

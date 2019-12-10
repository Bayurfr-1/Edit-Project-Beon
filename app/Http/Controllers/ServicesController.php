<?php

namespace App\Http\Controllers;

use editServices;
use App\Services;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function getAll($limit = 10, $offset = 0){
        $data["count"] = Services::count();
        $services = array();

        foreach (Services::take($limit)->skip($offset)->get() as $p) {
            $item = [
                "id"          => $p->id,
                "userid"        => $p->userid,
                "name"   => $p->name,
                "descriptions"   => $p->descriptions,
                "minimumprice"   => $p->minimumprice,
                "status"   => $p->status,
                "created_at"  => $p->created_at,
                "updated_at"  => $p->updated_at
            ];

            array_push($services, $item);
        }
        $data["services"] = $services;
        $data["status"] = 1;
        return response($data);
    }

    public function update(Request $request)
	{
		//proses update data
		$services = Services::where('id', $request->id)->first();
		$services->userid 	= $request->userid;
        $services->name 	= $request->name;
        $services->descriptions 	= $request->descriptions;
        $services->minimumprice 	= $request->minimumprice;
        $services->status 	= $request->status;
		$services->save();


		return response()->json([
			'status'	=> '1',
			'message'	=> 'Services berhasil diubah'
		], 201);
    }
    public function show($id){
        $services = Services::find($id);
        return response($services);
    }
}

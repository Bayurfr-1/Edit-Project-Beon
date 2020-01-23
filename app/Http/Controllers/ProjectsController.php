<?php

namespace App\Http\Controllers;

use Auth;
use App\Projects;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function getAll($limit = 10, $offset = 0){
        $data["count"] = Projects::count();
        $projects = array();

        foreach (Projects::take($limit)->skip($offset)->get() as $p) {
            $item = [
                "id"          => $p->id,
                "userid"        => $p->userid,
                "descriptions"   => $p->descriptions,
                "budget"          => $p->budget,
                "type"   => $p->type,
                "projectname"          => $p->projectname,
                "status"   => $p->status,
                "created_at"  => $p->created_at,
                "updated_at"  => $p->updated_at
            ];

            array_push($projects, $item);
        }
        $data["projects"] = $projects;
        $data["status"] = 1;
        return response($data);
    }

    public function update(Request $request)
	{
		//proses update data
		$projects = Projects::where('id', $request->id)->first();
		$projects->userid 	= $request->userid;
        $projects->descriptions 	= $request->descriptions;
        $projects->budget 	= $request->budget;
        $projects->type 	= $request->type;
        $projects->projectname 	= $request->projectname;
        $projects->status 	= $request->status;
		$projects->save();


		return response()->json([
			'status'	=> '1',
			'message'	=> 'Projects berhasil diubah'
		], 201);
    }
    public function show($id){
        $projects = Projects::find($id);
        return response($projects);
    }
}
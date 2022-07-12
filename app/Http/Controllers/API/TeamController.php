<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\Validator;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return response()->json([
            'status'=> 200,
            'teams'=>$teams,
        ]);
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tittle' => 'required|max:191',
            'designation' => 'required|max:191',
            'description' => 'nullable|max:5000',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>422,
                'errors'=>$validator->messages(),
            ]);

        }
        else
        {
            $team = new Team;
            $team->tittle = $request->input('tittle');
            $team->designation = $request->input('designation');
            $team->description = $request->input('description');
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() .','.$extension;
                $file->move('uploads/team/', $filename);
                $team->image = 'uploads/team/'.$filename;
            }
            $team->save();
            return response()->json([
                'status'=>200,
                'message'=>'Team Added Successfully',
            ]);







            //last

        }
    }

    public function destroy($id)
    {
        $team = Team::find($id);
            if($team)
            {
                $team->delete();
                return response()->json([
                    'status'=>200,
                    'message'=>'deleted Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'deleted',
                ]);
            }
    }
}

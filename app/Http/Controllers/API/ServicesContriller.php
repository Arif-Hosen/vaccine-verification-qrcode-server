<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicesContriller extends Controller
{
    public function index()
    {
        $servicess = Services::all();
        return response()->json([
            'status'=> 200,
            'servicess'=>$servicess,
        ]);
    }


    // public function edit($id)
    // {
    //     $services = Services::find($id);
    //     if($services)
    //         {
    //             return response()->json([
    //                 'status'=>200,
    //                 'services'=>$services,
    //             ]);
    //         }
    //     else
    //     {
    //         return response()->json([
    //             'status'=>404,
    //             'message'=>'No Services id found',
    //         ]);
    //     }
    // }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tittle' => 'required|max:191',
            'description' => 'required|max:191',
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
            $services = new Services;
            $services->tittle = $request->input('tittle');
            $services->description = $request->input('description');
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() .','.$extension;
                $file->move('uploads/services/', $filename);
                $services->image = 'uploads/services/'.$filename;
            }
            $services->save();
            return response()->json([
                'status'=>200,
                'message'=>'Services Added Successfully',
            ]);







            //last

        }
    }

    public function destroy($id)
    {
        $services = Services::find($id);
            if($services)
            {
                $services->delete();
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



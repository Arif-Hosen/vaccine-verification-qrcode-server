<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Header;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HeaderController extends Controller
{
    public function index()
    {
        $headers = Header::all();
        return response()->json([
            'status'=> 200,
            'headers'=>$headers,
        ]);
    }


    public function edit($id)
    {
        $header = Header::find($id);
        if($header)
            {
                return response()->json([
                    'status'=>200,
                    'header'=>$header,
                ]);
            }
        else
        {
            return response()->json([
                'status'=>404,
                'message'=>'No Header id found',
            ]);
        }
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tittle' => 'required|max:191',
            'description' => 'required|max:500',
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
            $header = new Header;
            $header->tittle = $request->input('tittle');
            $header->description = $request->input('description');
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() .','.$extension;
                $file->move('uploads/header/', $filename);
                $header->image = 'uploads/header/'.$filename;
            }
            $header->save();
            return response()->json([
                'status'=>200,
                'message'=>'Header Added Successfully',
            ]);


        }
    }
    public function destroy($id)
    {
        $header = Header::find($id);
            if($header)
            {
                $header->delete();
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

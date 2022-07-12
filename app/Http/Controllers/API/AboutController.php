<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use Illuminate\Support\Facades\Validator;

class AboutController extends Controller
{
    public function index()
    {
        $abouts = About::all();
        return response()->json([
            'status'=> 200,
            'abouts'=>$abouts,
        ]);
    }


    public function edit($id)
    {
        $about = About::find($id);
        if($about)
        {
            return response()->json([
                'status' => 200,
                'about' =>$about
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' =>'No About Found'
            ]);
        }
    }


    // public function edit($id)
    // {
    //     $about = About::find($id);
    //     if($about)
    //         {
    //             return response()->json([
    //                 'status'=>200,
    //                 'about'=>$about,
    //             ]);
    //         }
    //     else
    //     {
    //         return response()->json([
    //             'status'=>404,
    //             'message'=>'No About id found',
    //         ]);
    //     }
    // }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|max:9000',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg,gif|max:2048',
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
            $about = new About;
            $about->description = $request->input('description');
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() .','.$extension;
                $file->move('uploads/about/', $filename);
                $about->image = 'uploads/about/'.$filename;
            }
            $about->save();
            return response()->json([
                'status'=>200,
                'message'=>'About Added Successfully',
            ]);







            //last

        }
    }

    public function destroy($id)
    {
        $about = About::find($id);
            if($about)
            {
                $about->delete();
                return response()->json([
                    'status'=>200,
                    'message'=>'Deleted Successfully',
                ]);
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'Deleted',
                ]);
            }
    }
}

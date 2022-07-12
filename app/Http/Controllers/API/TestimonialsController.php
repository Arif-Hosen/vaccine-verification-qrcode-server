<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonials;
use Illuminate\Support\Facades\Validator;

class TestimonialsController extends Controller
{
    public function index()
    {
        $testimonialss = Testimonials::all();
        return response()->json([
            'status'=> 200,
            'testimonialss'=>$testimonialss,
        ]);
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tittle' => 'required|max:191',
            'names' => 'required|max:191',
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
            $testimonials = new Testimonials;
            $testimonials->tittle = $request->input('tittle');
            $testimonials->names = $request->input('names');
            $testimonials->description = $request->input('description');
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() .','.$extension;
                $file->move('uploads/testimonials/', $filename);
                $testimonials->image = 'uploads/testimonials/'.$filename;
            }
            $testimonials->save();
            return response()->json([
                'status'=>200,
                'message'=>'Testimonials Added Successfully',
            ]);







            //last

        }
    }

    public function destroy($id)
    {
        $testimonials = Testimonials::find($id);
            if($testimonials)
            {
                $testimonials->delete();
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

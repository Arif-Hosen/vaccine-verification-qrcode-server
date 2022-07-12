<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::all();
        return response()->json([
            'status'=> 200,
            'blogs'=>$blogs,
        ]);
    }



    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category' => 'required|max:191',
            'tittle' => 'required|max:191',

            'description' => 'required|max:5500',
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
            $blog = new Blog;
            $blog->category = $request->input('category');
            $blog->tittle = $request->input('tittle');
            $blog->description = $request->input('description');
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() .','.$extension;
                $file->move('uploads/blog/', $filename);
                $blog->image = 'uploads/blog/'.$filename;
            }
            $blog->save();
            return response()->json([
                'status'=>200,
                'message'=>'Testimonials Added Successfully',
            ]);







            //last

        }
    }

    public function destroy($id)
    {
        $blog = Blog::find($id);
            if($blog)
            {
                $blog->delete();
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

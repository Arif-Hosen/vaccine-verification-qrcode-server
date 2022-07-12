<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PdfForm;
use Illuminate\Support\Facades\Validator;

class PdfController extends Controller
{


    public function index()
    {
        $allpdf = PdfForm::all();
        return response()->json([
            'status'=> 200,
            'allpdf'=>$allpdf,
        ]);
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'certificateno' => 'required|max:1000',
            'nidnumber' => 'required|max:1000',
            'passportno' => 'required|max:1000',
            'nationality' => 'required|max:1000',
            'name' => 'required|max:1000',
            'dateofbirth' => 'required|max:1000',
            'gender' => 'required|max:1000',
            'datedose1' => 'required|max:1000',
            'namedose1' => 'required|max:1000',
            'dateofdose2' => 'required|max:1000',
            'namedose2' => 'required|max:1000',
            'vaccincenter' => 'required|max:1000',
            'vaccinatedby' => 'required|max:1000',
            'totaldose' => 'required|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=>422,
                // 'errors'=>$validator->messages(),
            ]);

        }
        else
        {
            $pdf = new PdfForm;
            $pdf->certificateno = $request->input('certificateno');
            $pdf->nidnumber = $request->input('nidnumber');
            $pdf->passportno = $request->input('passportno');
            $pdf->nationality = $request->input('nationality');
            $pdf->name = $request->input('name');
            $pdf->dateofbirth = $request->input('dateofbirth');
            $pdf->gender = $request->input('gender');
            $pdf->datedose1 = $request->input('datedose1');
            $pdf->namedose1 = $request->input('namedose1');
            $pdf->dateofdose2 = $request->input('dateofdose2');
            $pdf->namedose2 = $request->input('namedose2');
            $pdf->vaccincenter = $request->input('vaccincenter');
            $pdf->vaccinatedby = $request->input('vaccinatedby');
            $pdf->totaldose = $request->input('totaldose');
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() .','.$extension;
                $file->move('uploads/pdf/', $filename);
                $pdf->image = 'uploads/pdf/'.$filename;
            }
            $pdf->save();
            
            return response()->json([
                'status'=>200,
                'message'=>'pdf Added Successfully',
            ]);


        }
    }
}

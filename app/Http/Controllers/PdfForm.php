<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PdfForm extends Controller
{
    public function store(Request $request){
        $t= $request->man;
        return $t;
    }
}

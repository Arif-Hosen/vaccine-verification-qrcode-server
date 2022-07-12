<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfForm extends Model
{
    use HasFactory;
    protected $table = 'pdftable';
    protected $fillable = [
        'certificateno',
        'nidnumber',
        'passportno',
        'nationality',
        'name',
        'dateofbirth',
        'gender',
        'datedose1',
        'namedose1',
        'dateofdose2',
        'namedose2',
        'vaccincenter',
        'vaccinatedby',
        'totaldose',
        'image',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Register extends Model
{
    use HasFactory;

    protected $fillable = ['r_fname', 'r_lname', 'r_year','r_mobile','r_scnum','r_email','r_workplace','r_role','r_position','r_imgpath'];
}

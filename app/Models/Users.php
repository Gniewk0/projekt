<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    public $timestamps = false;
    // protected $guarded =[];
    public static $rules = [
        'name' => 'required',
        'surname' => 'required',
        'age' => 'required',
        'sex' => 'required',
        'address' => 'required',
    ];
    public static $updaterules = [
        'name' => 'required',
        'surname' => 'required',
        'age' => 'required',
        'sex' => 'required',
        'address' => 'required',
    ];
}

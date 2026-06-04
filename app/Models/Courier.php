<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



#[Fillable(['first_name', 'last_name', 'level'])]
class Courier extends Model
{
    use HasFactory;

}

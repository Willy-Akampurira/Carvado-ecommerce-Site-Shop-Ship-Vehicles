<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    // Allow mass assignment for the email field
    protected $fillable = ['email'];
}

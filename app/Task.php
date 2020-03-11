<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    //
    
    protected $fillable = [ 'id','name','creatorid' ,'description','duedate','status' ];
    
}

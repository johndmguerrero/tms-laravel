<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $fillable = [ 'id','name','creatorid','description','duedate','status' ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidManagementWorkOrderProjectDetails extends Model
{
    use HasFactory;
    protected $fillable = ['bidid','ProPeriod','mobPeriod','monsoonPeriod','monthDuration','supplyScape','supplyDate','erectionStart','commercialProduc','tarCompletion','producCompletion','createdby_userid','updatedby_userid'];
}

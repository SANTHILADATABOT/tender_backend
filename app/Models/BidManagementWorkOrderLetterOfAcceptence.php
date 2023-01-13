<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidManagementWorkOrderLetterOfAcceptence extends Model
{
    use HasFactory;
    protected $fillable = ['bidid','date','refrenceno','from','medium','medRefrenceno','mediumSelect','createdby_userid','updatedby_userid'];
}

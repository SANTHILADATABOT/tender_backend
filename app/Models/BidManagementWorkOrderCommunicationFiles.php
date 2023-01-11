<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidManagementWorkOrderCommunicationFiles extends Model
{
    use HasFactory;
    protected $fillable = ['bidid','Date','RefrenceNo','From','To','Subject','Medium','comfile','created_userid','updated_userid'];

}

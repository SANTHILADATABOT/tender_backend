<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunicationFiles extends Model
{
    use HasFactory;
    protected $fillable = ['Date','RefrenceNo','From','To','Subject','Medium','FileDetails','cr_userid','edited_userid'];

}

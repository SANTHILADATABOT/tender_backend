<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompetitorDetailsLineOfBusiness extends Model
{
    use HasFactory;
    protected $fillable = ['compId','compNo','business_line','remark','cr_userid','edited_userid'];
}

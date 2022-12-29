<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenderTypeMaster extends Model
{
    use HasFactory;
    protected $fillable = ['tendertype','tendertypeStatus'];
}

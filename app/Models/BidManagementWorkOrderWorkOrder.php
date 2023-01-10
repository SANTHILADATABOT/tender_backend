<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BidManagementWorkOrderWorkOrder extends Model
{
    use HasFactory;

    protected $fillable = ['bidid','orderQuantity','PricePerUnit','LoaDate','OrderDate','AgreeDate','SiteHandOverDate','filetype_I','filetype_II','filetype_III','createdby_userid','updatedby_userids'];
}

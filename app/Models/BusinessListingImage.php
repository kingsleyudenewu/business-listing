<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessListingImage extends Model
{
    use SoftDeletes;

    public function businessListing()
    {
        return $this->belongsTo(BusinessListing::class);
    }
}

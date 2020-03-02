<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    public function businessListings()
    {
        return $this->belongsToMany(BusinessListing::class, 'business_listing_category')
            ->withPivot('is_default');
    }
}

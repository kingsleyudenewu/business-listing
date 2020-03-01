<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessListing extends Model
{
    use SoftDeletes;

    public function businessListingImage()
    {
        return $this->hasMany(BusinessListingImage::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'business_listing_category');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessListingRequest;
use App\Models\BusinessListing;
use App\Models\BusinessListingImage;
use Illuminate\Http\Request;

class BusinessListingController extends Controller
{
    public function index()
    {
        $pageTitle = 'Listing';
        $businessListings = BusinessListing::paginate(15);
        return view('category.index', compact('businessListings', 'pageTitle'));
    }

    public function store(BusinessListingRequest $request)
    {
        $businessListing = BusinessListing::firstOrCreate([
            'name' => $request->name
        ],[
            'description' => $request->description,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        if ($businessListing) {
            // Check if image is added
            if ($request->filled('image')) {
                BusinessListingImage::create([
                    'business_listing_id' => $businessListing->id,
                    'image' => $request->file('image')->store('listing', 'public'),
                    'is_default' => $request->is_default ?? 0,
                ]);
            }
            return redirect()->back()->with('success', 'Operation Successful');
        }
        return redirect()->back()->with('errors', 'Operation failed');
    }

    public function show(BusinessListing $businessListing)
    {
        if (!is_null($businessListing)) {
            return response()->json([
                'status' => true,
                'data' => $businessListing,
                'message' => 'success'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'failed'
        ]);
    }

    public function update(BusinessListingRequest $request, BusinessListing $businessListing)
    {
        $update = BusinessListing::find($businessListing->id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        if ($update) {
            // Check if the image is set to default and is_default was selected
            if ($request->is_default == '1') {
                $defaultImage = BusinessListingImage::where('business_listing_id', $businessListing->id)
                    ->where('is_default', 1)
                    ->first();

                if (!is_null($defaultImage)) {
                    // Set the previous default to 0
                    $defaultImage->update([
                       'is_default' => 0
                    ]);
                }
            }

        }
    }
}

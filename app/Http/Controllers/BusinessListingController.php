<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessListingRequest;
use App\Http\Requests\UploadListingRequest;
use App\Models\BusinessListing;
use App\Models\BusinessListingImage;
use Illuminate\Http\Request;

class BusinessListingController extends Controller
{
    public function index()
    {
        $pageTitle = 'Listing';
        $businessListings = BusinessListing::paginate(15);
        return view('business_listing.index', compact('businessListings', 'pageTitle'));
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
            // Update the views the listing details is clicked
            $businessListing->views += 1;
            $businessListing->save();
            return view('business_listing.show', compact('businessListing'));
        }

        return redirect()->back()->with('errors', 'Listing not found');
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

    public function uploadListingImage(UploadListingRequest $request)
    {

    }

    public function searchListing(Request $request)
    {
        $listing = BusinessListing::where('name', 'like', '%'.$request->search.'%')
            ->orWhere('description', 'like', '%'.$request->search.'%')
            ->get();

        if ($listing) {
            return response()->json([
               'status' => true,
               'data' => $listing,
               'message' => 'success'
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'failed'
        ]);
    }
}

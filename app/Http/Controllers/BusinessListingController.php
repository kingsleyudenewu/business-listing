<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessListingRequest;
use App\Http\Requests\UploadListingRequest;
use App\Models\BusinessListing;
use App\Models\BusinessListingImage;
use App\Models\Category;
use Illuminate\Http\Request;

class BusinessListingController extends Controller
{
    public function index()
    {
        $pageTitle = 'BusinessListing';
        $categories = Category::all();
        $businessListings = BusinessListing::paginate(15);
        return view('business_listing.index', compact('businessListings', 'pageTitle', 'categories'));
    }

    public function store(BusinessListingRequest $request)
    {
        $businessListing = BusinessListing::create([
            'name' => $request->name,
            'description' => $request->description,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        if ($businessListing) {
            $businessListing->categories()->attach($request->category_id);
            // Check if image is added
            if ($request->has('image')) {
                BusinessListingImage::create([
                    'business_listing_id' => $businessListing->id,
                    'image' => $request->file('image')->store('listing', 'public'),
                    'is_default' => 1,
                ]);
            }
            return redirect()->back()->with('success', 'Operation Successful');
        }
        return redirect()->back()->with('errors', 'Operation failed');
    }

    public function show($id)
    {
        $businessListing = BusinessListing::with('categories', 'businessListingImage')->find($id);
        if (!is_null($businessListing)) {
            $pageTitle = 'Listing';
            // Update the views the listing details is clicked
            $businessListing->views += 1;
            $businessListing->save();
            return view('business_listing.show', compact('businessListing', 'pageTitle'));
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
            return redirect()->back()->with('success', 'Operation Successful');
        }
        return redirect()->back()->with('errors', 'Operation failed');
    }

    public function uploadListingImage(UploadListingRequest $request)
    {
        // Check if the image is set to default and is_default was selected
        if ($request->is_default == '1') {
            $defaultImage = BusinessListingImage::where('is_default', 1)
                ->where('business_listing_id', $request->business_listing_id)
                ->first();

            if (!is_null($defaultImage)) {
                // Set the previous default to 0
                $defaultImage->update([
                    'is_default' => 0
                ]);
            }
        }

        // Upload image to listing table
        $uploadImage = BusinessListingImage::create([
            'is_default' => $request->is_default,
            'image' => $request->file('image')->store('listing', 'public'),
            'business_listing_id' => $request->business_listing_id,
        ]);

        if ($uploadImage) {
            return redirect()->back()->with('success', 'Operation Successful');
        }
        return redirect()->back()->with('errors', 'Operation failed');
    }

    public function searchListing(Request $request)
    {
        $listing = BusinessListing::where('name', 'like', '%' . $request->search . '%')
            ->orWhere('description', 'like', '%' . $request->search . '%')
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

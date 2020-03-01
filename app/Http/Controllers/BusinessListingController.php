<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessListingRequest;
use App\Models\BusinessListing;
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
}

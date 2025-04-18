<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    //frontend routes
    public function vendorRegister()
    {
        $user = Auth::user();
        $vendor = Vendor::where('user_id', $user->id)->first();

        return view('site.pages.become_a_seller', compact('vendor'));
    }

    public function store(Request $request,  $id = null)
    {

        $user = Auth::user();

        $validated = $request->validate([
            'vendor_name'         => 'required|string|max:100',
            'vendor_email' => 'required|email|unique:vendors,vendor_email,' . $user->id . ',user_id',
            'city'                => 'required',
            'vendor_address'      => 'required|string|max:100',
            'phone_number'        => 'required|digits:10',
            'pan_number'          => 'required|digits:9',
            'vendor_profile_img'  => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'document'            => 'nullable|mimes:pdf|max:5120',
        ]);


        // try {
        $vendor = Vendor::updateOrCreate(
            ['user_id' => $user->id],
            [
                'vendor_name'    => $request->vendor_name,
                'vendor_email'   => $request->vendor_email,
                'city'           => $request->city,
                'vendor_address' => $request->vendor_address,
                'phone_number'   => $request->phone_number,
                'pan_number'     => $request->pan_number,
                'vendor_status' => 'pending',
            ]
        );

        // Handle vendor profile image upload
        if ($request->hasFile('vendor_profile_img')) {
            $image = $request->file('vendor_profile_img');
            $imageName = time() . rand(100000, 999999) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('vendors', $imageName, 'public');
            $vendor->vendor_profile_img = $imageName;
        }

        // Handle document upload
        if ($request->hasFile('document')) {
            $document = $request->file('document');
            $documentName = time() . rand(100000, 999999) . '.' . $document->getClientOriginalExtension();
            $document->storeAs('documents', $documentName, 'public');
            $vendor->document = $documentName;
        }

        $vendor->save(); // Don't forget to save the model after updating fields

        $message = $vendor->wasRecentlyCreated
            ? 'Your application has been submitted successfully.'
            : 'Your application has been updated successfully.';

        toastr()->success($message);
        return redirect()->back();


        // } catch (\Throwable $e) {
        //     toastr()->error('Something went wrong. Please try again later.');
        //     return redirect()->back();
        // }
    }


    public function vendorRequest()
    {
        $vendorRequests = Vendor::where('vendor_status', 'pending')->get();
        return view('admin.vendor.vendor_request', compact('vendorRequests'));
    }

    public function handleRequest(Request $request, $id)
    {
        $validated = $request->validate([

            'status' => 'required|in:active,rejected',
            'message' => 'nullable|string',
        ]);

        $vendor = Vendor::find($id);
        $user = User::find($vendor->user_id);

        // dd($user);

        $vendor->vendor_status = $request->status;
        $vendor->save();
        if ($request->status === 'active')
            $user->role = 'vendor';
        $user->save();

        toastr()->success('Request has been updated to ' . $request->status);
        return redirect()->back();
    }


    //order
    public function getVendorDetails($id)
    {
        $vendor = Vendor::find($id);
        $products = Product::where('vendor_id', $vendor->id)->get();

        return view('vendor.vendor_products', compact('vendor', 'products'));
    }
}

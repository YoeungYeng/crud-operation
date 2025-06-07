<?php

namespace App\Http\Controllers;

use App\Models\Brand as ModelsBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Brand extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = ModelsBrand::all();
        return view('brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->errors()
            ], 400);
        }
        // Handle file upload for logo if present
        if ($request->hasFile('logo')) {
            // check if image is valid
            $image = $request->file('logo');
            if (!$image->isValid()) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Invalid image file',
                ], 400);
            }
        }

        // Save image to database
        if ($request->hasFile('logo')) {
            $image_path = $request->file('logo')->store('assets', 'public'); // Store in storage/app/public/assets
            $logoPath = $image_path; // Save relative path for DB
        } else {
            $logoPath = null; // If no logo is uploaded, set to null
        }

        // Save the brand to the database
        ModelsBrand::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'logo' => $logoPath
        ]);



        return redirect()->route('brand.index')->with('success', 'Brand created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $brand = ModelsBrand::findOrFail($id);
        $brands = ModelsBrand::all(); // <-- get all categories for the table

        return view('brand.edit', compact('brand', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the brand
        $brand = ModelsBrand::findOrFail($id);

        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->errors()
            ], 400);
        }

        // Handle file upload
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');

            if (!$image->isValid()) {
                return response()->json([
                    'status' => 400,
                    'message' => 'Invalid image file',
                ], 400);
            }

            // Optionally: Delete old image if needed
            // Storage::disk('public')->delete($brand->logo);

            // Store new image and update path
            $image_path = $image->store('assets', 'public');
            $brand->logo = $image_path;
        }

        // Update the brand data
        $brand->name = $request->input('name');
        $brand->email = $request->input('email');
        $brand->phone = $request->input('phone');
        $brand->save();

        return redirect()->route('brand.index')->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $brand = ModelsBrand::findOrFail($id);
        $brand->delete();

        return redirect()->route('brand.index')->with('success', 'Brand deleted successfully.');
    }
}

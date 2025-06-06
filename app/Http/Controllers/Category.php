<?php

namespace App\Http\Controllers;

use App\Models\Category as ModelCateogy;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Category extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = ModelCateogy::all(); // fetch all records
        return view('category.create', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);
        // If validation fails, redirect back with a message
        if ($validator->fails()) {
            return redirect()->route('category.index')->with('error', 'Validation failed.');
        }
        // Save the brand to the database
        ModelCateogy::create([
            'name' => $request->name,

        ]);

        // Redirect to index or another page with a success message
        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Retrieve the category by ID
        $category = ModelCateogy::findOrFail($id); // Use findOrFail for better error handling

        // Pass the category to a proper view
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = ModelCateogy::findOrFail($id);
        $categories = ModelCateogy::all(); // <-- get all categories for the table

        return view('category.edit', compact('category', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        // If validation fails, redirect back with a message
        if ($validator->fails()) {
            return redirect()->route('category.index')->with('error', 'Validation failed.');
        }

        // Find the category by ID
        $category = ModelCateogy::findOrFail($id);

        // Update the category
        $category->name = $request->input('name');
        $category->save();

        // Redirect with success message
        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = ModelCateogy::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }

}

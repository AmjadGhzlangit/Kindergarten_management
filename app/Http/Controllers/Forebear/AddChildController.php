<?php

namespace App\Http\Controllers\Forebear;

use App\Models\Forebear;
use App\Models\Child;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Storage;

class AddChildController extends Controller
{
    public function index()
    {
        // Fetch all children with their related data
        $children = Child::with(['user', 'forebear.user'])->paginate(6);
        return view('Dashboard.Forebear.pages.index', compact('children'));
    }

    public function show($id)
    {
        // Find a specific child by ID
        $child = Child::with(['user', 'forebear.user'])->findOrFail($id);
        return view('Dashboard.Forebear.pages.show', compact('child'));
    }
    
    public function create()
    {
        // Fetch forebears and users for the create form
        $forebears = Forebear::with('user')->get();
        $users = User::all();
        return view('Dashboard.Forebear.pages.create', compact('forebears', 'users'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'forebear_id' => 'required|exists:forebears,id',
            'age' => 'required|integer|min:0',
            'education_stage' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images/users', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Create the new child
        $child = Child::create($validatedData);

        return redirect()->route('forebear_child.show', ['forebear_child' => $child->id])
                         ->with('success', 'Child created successfully.');
    }

    public function edit($id)
    {
        // Fetch the child by ID
        $users = User::all();
        $forebears = Forebear::all();
        $child = Child::findOrFail($id);
        return view('Dashboard.Forebear.pages.edit', compact('child', 'users', 'forebears'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'user_id' => 'exists:users,id', // Check if user_id exists in users table
            'forebear_id' => 'exists:forebears,id', // Check if forebear_id exists in forebears table
            'age' => 'required|integer|min:0', // Age must be an integer and at least 0
            'education_stage' => 'required|string|max:255', // Education stage must be a string
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validations
        ]);

        // Fetch the existing child by ID
        $child = Child::findOrFail($id); // Ensure the child exists
        
        // Handle image update
        if ($request->hasFile('image')) {
            // Delete previous image if exists
            if ($child->user->image) {
                Storage::disk('public')->delete($child->user->image);
            }
            // Upload new image
            $imagePath = $request->file('image')->store('images/users', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Update the child with the validated data
        $child->update($validatedData);

        return redirect()->route('forebear_child.show', ['forebear_child' => $child->id])
                         ->with('success', 'Child updated successfully.');
    }

    public function destroy($id)
    {
        // Find and delete the child
        $child = Child::findOrFail($id);

        // Delete child's image if exists
        if ($child->user->image) {
            Storage::disk('public')->delete($child->user->image);
        }

        $child->delete();

        return redirect()->route('forebear_child.index')
                         ->with('success', 'Child deleted successfully.');
    }
}


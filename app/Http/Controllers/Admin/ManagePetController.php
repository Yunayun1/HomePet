<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use App\Models\User;
use App\Models\AdoptionApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManagePetController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $pets = Pet::with('shelter')
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->paginate(10);

        // Load all adoption applications (you can optimize this if needed)
        $adoptionApplications = AdoptionApplication::all();

        return view('admin.managepet.index', compact('pets', 'adoptionApplications'));
    }


    public function create()
    {
        $shelters = User::where('role', 'shelter')->get();
        return view('admin.managepet.create', compact('shelters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'age' => 'nullable|string|max:50',
            'behavior' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'shelter_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('pets', 'public');
        }

        Pet::create($data);

        return redirect()->route('admin.managepet.index')->with('success', 'Pet added successfully.');
    }

    public function edit($id)
    {
        $pet = Pet::findOrFail($id);
        $shelters = User::where('role', 'shelter')->get();
        return view('admin.managepet.edit', compact('pet', 'shelters'));
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'age' => 'nullable|string|max:50',
            'behavior' => 'nullable|string|max:255',
            'location' => 'nullable|string|max:255',
            'shelter_id' => 'required|exists:users,id',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('image')) {
            if ($pet->image) {
                Storage::disk('public')->delete($pet->image);
            }
            $data['image'] = $request->file('image')->store('pets', 'public');
        }

        $pet->update($data);

        return redirect()->route('admin.managepet.index')->with('success', 'Pet updated successfully.');
    }

    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);

        if ($pet->image) {
            Storage::disk('public')->delete($pet->image);
        }

        $pet->delete();

        return redirect()->route('admin.managepet.index')->with('success', 'Pet deleted successfully.');
    }
}

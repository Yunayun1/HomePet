<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShelterApplication;

class ShelterController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status');
        $query = ShelterApplication::query();

        if (in_array($status, ['pending', 'approved', 'rejected'])) {
            $query->where('status', $status);
        }

        $shelters = $query->latest()->get(); // Get all, no pagination

        return view('admin.shelters.index', compact('shelters'));
    }

    public function show($id)
    {
        return view('admin.shelters.show', [
            'shelter' => ShelterApplication::findOrFail($id),
        ]);
    }

    public function edit($id)
    {
        return view('admin.shelters.edit', [
            'shelter' => ShelterApplication::findOrFail($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:pending,approved,rejected',
            // Add other fields validation here if needed
        ]);

        $shelter = ShelterApplication::findOrFail($id);
        $shelter->status = $request->status;
        // Update other fields here if needed
        $shelter->save();

        return redirect()->route('admin.shelters.index')->with('success', 'Shelter application updated successfully!');
    }

    public function destroy($id)
    {
        ShelterApplication::findOrFail($id)->delete();

        return redirect()->route('admin.shelters.index')->with('success', 'Shelter application deleted successfully!');
    }
}

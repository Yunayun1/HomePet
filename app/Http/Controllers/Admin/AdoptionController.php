<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdoptionApplication; // use the correct model

class AdoptionController extends Controller
{
    // Show list of all adoption applications
    public function index()
    {
        $adoptions = AdoptionApplication::all(); // fetch from adoption_applications table
        return view('admin.adoptions.index', compact('adoptions'));
    }

    // Show edit form
    public function edit($id)
    {
        $adoption = AdoptionApplication::findOrFail($id);
        return view('admin.adoptions.edit', compact('adoption'));
    }

    // Handle update of status
    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Approved,Rejected',
        ]);

        $adoption = AdoptionApplication::findOrFail($id);
        $adoption->status = $request->status;
        $adoption->save();

        return redirect()->route('admin.adoptions.index')->with('success', 'Adoption status updated.');
    }

    // Delete application
    public function destroy($id)
    {
        $adoption = AdoptionApplication::findOrFail($id);
        $adoption->delete();

        return redirect()->route('admin.adoptions.index')->with('success', 'Adoption deleted.');
    }
}

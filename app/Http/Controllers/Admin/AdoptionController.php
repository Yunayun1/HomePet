<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Adoption;
use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    public function index()
    {
        $adoptions = Adoption::all();
        return view('admin.adoptions.index', compact('adoptions'));
    }

    public function edit($id)
    {
        $adoption = Adoption::findOrFail($id);
        return view('admin.adoptions.edit', compact('adoption'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Approved,Rejected',
        ]);

        $adoption = Adoption::findOrFail($id);
        $adoption->status = $request->status;
        $adoption->save();

        return redirect()->route('admin.adoptions.index')->with('success', 'Adoption status updated.');
    }

    public function destroy($id)
    {
        $adoption = Adoption::findOrFail($id);
        $adoption->delete();

        return redirect()->route('admin.adoptions.index')->with('success', 'Adoption deleted.');
    }
}

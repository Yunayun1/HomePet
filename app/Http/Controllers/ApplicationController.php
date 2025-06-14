<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdoptionApplication;
use App\Models\ShelterApplication;

class ApplicationController extends Controller
{
    public function showAdoptionForm()
    {
        return view('applications.adoption-form');
    }

    public function showShelterForm()
    {
        return view('applications.shelter-form');
    }

    public function submitAdoptForm(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'pet_name' => 'nullable|string|max:255',
            'reason' => 'required|string|min:10',
        ]);

        AdoptionApplication::create($data);

        return redirect()->back()->with('success', 'Your adoption application has been submitted!');
    }

    public function submitShelterForm(Request $request)
    {
        $data = $request->validate([
            'organization_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'address' => 'required|string|max:255',
            'proof_document' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'message' => 'nullable|string',
        ]);

        if ($request->hasFile('proof_document')) {
            $filePath = $request->file('proof_document')->store('proofs', 'public');
            $data['proof_document'] = $filePath;
        }

        ShelterApplication::create($data);

        return redirect()->back()->with('success', 'Your shelter application has been submitted!');
    }
}
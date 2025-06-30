<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdoptionApplication;
use App\Models\ShelterApplication;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    // Show adoption form
    public function showAdoptionForm()
    {
        return view('applications.adoption-form');
    }

    // Handle adoption form submission
    public function submitAdoption(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255',
            'phone'     => 'nullable|string|max:20',
            'pet_name'  => 'nullable|string|max:255',
        ]);

        AdoptionApplication::create($data);

        return redirect()->back()->with('success', 'Adoption application submitted successfully!');
    }

    // Show shelter form
    public function showShelterForm()
    {
        return view('application.shelter-form');
    }

    // Handle shelter form submission
    public function submitShelter(Request $request)
    {
        $data = $request->validate([
            'organization_name' => 'required|string|max:255',
            'email'             => 'required|email|max:255',
            'phone'             => 'nullable|string|max:20',
            'address'           => 'required|string|max:500',
            'proof_document'    => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
            'message'           => 'nullable|string',
        ]);

        // Handle file upload
        if ($request->hasFile('proof_document')) {
            $path = $request->file('proof_document')->store('proof_documents', 'public');
            $data['proof_document'] = $path;
        }

        ShelterApplication::create($data);

        return redirect()->back()->with('success', 'Shelter application submitted successfully!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SecureController extends Controller
{
    public function showForm()
    {
        return view('secure-form');
    }

    public function handleForm(Request $request)
    {
        // Process the form data securely
        $validatedData = $request->validate([
            'username' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        // Return success response
        return response()->json(['message' => 'Form submitted securely!', 'data' => $validatedData]);
    }
}

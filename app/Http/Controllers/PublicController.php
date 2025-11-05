<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PublicController extends Controller
{
    /**
     * Display the home page.
     */
    public function home()
    {
        return Inertia::render('Public/Home');
    }

    /**
     * Display the contact page.
     */
    public function contact()
    {
        return Inertia::render('Public/Contact');
    }

    /**
     * Handle contact form submission.
     */
    public function submitContact(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        // Log the contact form submission
        Log::info('Contact form submitted', [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'subject' => $validated['subject'],
        ]);

        // In production, send an email to support
        // Mail::to('support@eautogestion.bj')->send(new ContactFormMail($validated));

        // For now, we'll just log it
        // In a real application, you would send an email or save to database

        return back()->with('success', 'Votre message a été envoyé avec succès !');
    }

    /**
     * Display the privacy policy page.
     */
    public function privacy()
    {
        return Inertia::render('Public/Privacy');
    }

    /**
     * Display the terms and conditions page.
     */
    public function terms()
    {
        return Inertia::render('Public/Terms');
    }

    /**
     * Display the help page.
     */
    public function help()
    {
        return Inertia::render('Public/Help');
    }
}

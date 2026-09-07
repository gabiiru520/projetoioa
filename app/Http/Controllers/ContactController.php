<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Course;
use App\Models\PageContent;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contactContent = PageContent::getSection('contato', 'info');
        $courses = Course::where('is_active', true)->orderBy('title')->get();

        return view('contact', compact('contactContent', 'courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:50',
            'course_of_interest' => 'nullable|string|max:255',
            'message' => 'required|string|max:3000',
        ]);

        $validated['ip_address'] = $request->ip();

        ContactMessage::create($validated);

        return back()->with('success', 'Sua mensagem foi enviada com sucesso! Em breve um de nossos consultores entrará em contato com você.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $contacts = \App\Models\Contact::latest()->paginate(10);
        return view('admin.contacts.index', compact('contacts'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        \App\Models\Contact::create($validated);

        return redirect()->back()->with('success', 'تم إرسال رسالتك بنجاح!');
    }
    public function show($id)
    {
        $contact = \App\Models\Contact::findOrFail($id);
        return view('admin.contacts.show', compact('contact'));
    }
    public function destroy($id)
    {
        $contact = \App\Models\Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('admin.contacts.index')->with('success', 'تم حذف الرسالة بنجاح!');
    }
}

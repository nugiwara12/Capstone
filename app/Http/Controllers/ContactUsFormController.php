<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

class ContactUsFormController extends Controller
{
    public function index()
    {
        // You can add logic here to fetch and pass data to the index view if needed
        $contacts = Contact::all(); // Assuming you want to retrieve all contacts
        return view('contact.index', compact('contacts')); // Pass the contacts to the index view
    }

    // Create Contact Form
    public function createForm(Request $request)
        {
            return view('contact');
        }

        // Store Contact Form data
    public function ContactUsForm(Request $request)
    {
        // Form validation
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:11',
            'message' => 'required'
        ]);

        // Store data in the database
        Contact::create($request->all());

        // Define multiple recipients
        $recipients = ['gawanggamat1111@gmail.com'];

        // Send mail to admin(s)
        Mail::send('mail', array(
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'user_query' => $request->get('message'),
        ), function ($message) use ($request, $recipients) {
            $message->from($request->email);
            $message->to($recipients)->subject($request->get('message'));
        });

        return back()->with('success', 'We have received your message and would like to thank you for writing to us.');
    }


    // Show a specific contact
    public function show($id)
    {
        $contact = Contact::findOrFail($id);
        return view('contact.show', compact('contact')); // Replace 'contact.show' with the actual name of your show view
    }

    // Destroy (delete) a specific contact
    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully');
    }
}

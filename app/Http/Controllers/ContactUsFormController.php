<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Mail\SendContact; // Ensure this is the correct Mailable class
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator; // Make sure to import the Validator
use Illuminate\Support\Facades\Auth;

class ContactUsFormController extends Controller
{
    public function index()
    {
        if (!in_array(Auth::user()->role, ['admin', 'seller'])) {
            abort(404); // Return a 404 error if user is unauthorized
        }
        $contacts = Contact::paginate(request('per_page', 10)); // Default to 10 per page
        return view('contact.index', compact('contacts'));
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
        $contact = Contact::create($request->all());

        // Define multiple recipients
        $recipients = ['gawanggamat1111@gmail.com'];

        // Send mail to admin(s)
        Mail::send('mail', [
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'user_query' => $request->get('message'),
        ], function ($message) use ($request, $recipients) {
            $message->from($request->email);
            $message->to($recipients)->subject('New Contact Us Message');
        });

        // Send Thank You email to the user
        Mail::to($contact->email)->send(new SendContact($contact));

        return back()->with('success', 'We have received your message and would like to thank you for writing to us.');
    }

    // Show a specific contact
    public function show($id)
    {
        if (!in_array(Auth::user()->role, ['admin', 'seller'])) {
            abort(404); // Return a 404 error if user is unauthorized
        }
        $contact = Contact::findOrFail($id);
        return view('contact.show', compact('contact'));
    }

    // Destroy (delete) a specific contact
    public function destroy($id)
    {
        if (!in_array(Auth::user()->role, ['admin', 'seller'])) {
            abort(404); // Return a 404 error if user is unauthorized
        }
        $contact = Contact::findOrFail($id);
        $contact->delete();

        return redirect()->route('contacts.index')->with('success', 'Contact deleted successfully');
    }

    // Store Subscriber Email
    public function store(Request $request)
    {
        // Validate the request for subscriber email
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        // Check for validation errors
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422); // Unprocessable Entity
        }

        // Create a new subscriber record
        $contact = Contact::create([
            'email' => $request->input('email'),
        ]);

        // Send Thank You email
        Mail::to($contact->email)->send(new SendContact($contact));

        // Return a JSON response indicating success
        return response()->json([
            'success' => true,
            'message' => 'You have successfully subscribed!',
        ]);
    }

    public function showThankYou()
    {
        return view('emails.contact_us');
    }
}

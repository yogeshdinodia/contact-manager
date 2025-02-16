<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Show Contact list page (Home)
     *
     * @return void
     */
    public function index()
    {
        return view('contacts.index', ['contacts' => Contact::all()]);
    }

    /**
     * Show contact create blade page
     *
     * @return void
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Process custom add contact
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
        ]);

        $phone = preg_replace('/\s+/', '', $validated['phone']);
        if(Contact::where('phone', $phone)->exists()){
            return redirect()->route('contacts.index')->with('error', 'Contact with this phone number already exists.');
        }

        Contact::create([
            'name' => $validated['name'],
            'phone' => $phone,
        ]);

        return redirect()->route('contacts.index')->with('success', 'Contact added successfully!');
    }


    /**
     * Edit Contact page
     *
     * @param Contact $contact
     * @return void
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }

    /**
     * Process edit contact page
     *
     * @param Request $request
     * @param Contact $contact
     * @return void
     */
    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
        ]);
        $validated['phone'] = preg_replace('/\s+/', '', $validated['phone']);

        $duplicate = Contact::where('phone', $validated['phone'])->where('id', '!=', $contact->id)->exists();

        if($duplicate){
            return redirect()->back()->withErrors(['phone' => 'This phone number already exists.']);
        }
        $contact->update($validated);
        return redirect()->route('contacts.index')->with('success', 'Contact updated successfully!');
    }

    /**
     * Delete (Soft Delete)
     *
     * @param [type] $id
     * @return void
     */
    public function destroy($id) {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('contacts.index')->with('success', 'Contact moved to trash!');
    }

    /**
     * Import XML Bulk file upload
     *
     * @param Request $request
     * @return void
     */
    public function importXML(Request $request)
    {
        $request->validate([
            'xml_file' => 'required|mimes:xml',
        ]);

        // Read the XML file content properly
        $xmlContent = file_get_contents($request->file('xml_file')->getRealPath());
        $xml = simplexml_load_string($xmlContent);

        foreach($xml->contact as $c){
            $name = trim((string) $c->name);
            $phone = preg_replace('/\s+/', '', (string) $c->phone);

            // Check if a contact with the same name & phone already exists
            if(!Contact::where('name', $name)->where('phone', $phone)->exists()){
                Contact::create([
                    'name' => $name,
                    'phone' => $phone,
                ]);
            }
        }

        return redirect()->route('contacts.index')->with('success', 'Contacts imported successfully, duplicates skipped!');
    }

    /**
     * Show Trashed Contacts
     *
     * @return void
     */
    public function trashed() {
        $trashedContacts = Contact::onlyTrashed()->get();
        return view('contacts.trashed', compact('trashedContacts'));
    }

    /**
     * Process Restore Contact
     *
     * @param [type] $id
     * @return void
     */
    public function restore($id) {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->restore();
        return redirect()->route('contacts.trashed')->with('success', 'Contact restored!');
    }

    /**
     * Permanent Delete Contacts
     *
     * @param [type] $id
     * @return void
     */
    public function forceDelete($id) {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->forceDelete();
        return redirect()->route('contacts.trashed')->with('success', 'Contact permanently deleted!');
    }
}


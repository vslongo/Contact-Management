<?php

   namespace App\Http\Controllers;

   use App\Models\Contact;
   use Illuminate\Http\Request;
   use Illuminate\Support\Facades\Auth;

   class ContactController extends Controller
   {
       public function __construct()
       {
           $this->middleware('auth')->except(['index', 'show']);
       }

       public function index()
       {
           $contacts = Contact::all();
           return view('contacts.index', compact('contacts'));
       }

       public function create()
       {
           return view('contacts.create');
       }

       public function store(Request $request)
       {
           $validated = $request->validate([
               'name' => 'required|string|min:5',
               'contact' => 'required|digits:9|unique:contacts,contact',
               'email' => 'required|email|unique:contacts,email',
           ]);

           Contact::create($validated);
           return redirect()->route('contacts.index')->with('success', 'Contato criado com sucesso!');
       }

       public function show(Contact $contact)
       {
           return view('contacts.show', compact('contact'));
       }

       public function edit(Contact $contact)
       {
           return view('contacts.edit', compact('contact'));
       }

       public function update(Request $request, Contact $contact)
       {
           $validated = $request->validate([
               'name' => 'required|string|min:5',
               'contact' => 'required|digits:9|unique:contacts,contact,' . $contact->id,
               'email' => 'required|email|unique:contacts,email,' . $contact->id,
           ]);

           $contact->update($validated);
           return redirect()->route('contacts.index')->with('success', 'Contato atualizado com sucesso!');
       }

       public function destroy(Contact $contact)
       {
           $contact->delete();
           return redirect()->route('contacts.index')->with('success', 'Contato deletado com sucesso!');
       }
   }

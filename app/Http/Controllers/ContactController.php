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
        return $this->renderHtml('contact/index.html', ['contacts' => $contacts]);
    }

    public function create()
    {
        return $this->renderHtml('contact/create.html');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:5',
            'contact' => 'required|digits:9|unique:contacts,contact',
            'email' => 'required|email|unique:contacts,email',
        ]);

        Contact::create($validated);
        return redirect()->route('contact.index')->with('success', 'Contato criado com sucesso!');
    }

    public function show(Contact $contact)
    {
        return $this->renderHtml('contact/show.html', ['contact' => $contact]);
    }

    public function edit(Contact $contact)
    {
        return $this->renderHtml('contact/edit.html', ['contact' => $contact]);
    }

    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:5',
            'contact' => 'required|digits:9|unique:contacts,contact,' . $contact->id,
            'email' => 'required|email|unique:contacts,email,' . $contact->id,
        ]);

        $contact->update($validated);
        return redirect()->route('contact.index')->with('success', 'Contato atualizado com sucesso!');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect()->route('contact.index')->with('success', 'Contato deletado com sucesso!');
    }

    protected function renderHtml($viewPath, $data = [])
    {
        extract($data);
        ob_start();
        require resource_path('views/' . $viewPath);
        $content = ob_get_clean();
        return response()->file(resource_path('views/layouts/app.html'), ['content' => $content]);
    }
}

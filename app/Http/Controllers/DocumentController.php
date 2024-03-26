<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentFormRequest;
use App\Models\Document;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Document::class, 'document');
    }

    private function extractData (Document $document, DocumentFormRequest $request) {
        $data = $request->validated();
        $file = $request->validated('file');
        if ($file === null || $file->getError()) {
            $data['file'] = $document->file;
            return $data;
        }
        if ($document->file !== null) {
            Storage::disk('public')->delete($document->file);
        }
        $data['file'] = $file->store('documents', 'public');
        return $data;
    }

    public function index()
    {
        $documents = Document::orderBy('created_at', 'desc')->paginate(10);
        return view('rh.documents.index', compact('documents'));
    }

    public function create()
    {
        $types = [
            'Pièce d\'identité',
            'Curriculum vitae',
            'Diplôme',
            'Contrat de travail',
            'Facture',
            'Bon de commande',
            'Devis',
            'Contrat commercial',
            'Relevé bancaire',
            'Rapport d\'activité',
            'Compte-rendu de réunion',
            'Procès-verbal d\'assemblée générale',
            'Statuts de l\'entreprise',
            'Document de présentation',
            'Document technique',
            'Correspondance'
        ];
        return view('rh.documents.form',
            [
                'document' => new Document(),
                'staffs' => Staff::all(),
                'types' => $types
            ]
        );
    }

    public function store(DocumentFormRequest $request)
    {
        $data = $this->extractData(new Document(), $request);
        Document::create([
            'staff_id' => $data['staff_id'],
            'file' => $data['file'],
            'type' => $data['type']
        ]);
        return redirect()->route('rh.documents.index');
    }

    public function show(Document $document)
    {
        return view('rh.documents.show', compact('document'));
    }

    public function edit(Document $document)
    {
        return view('rh.documents.form',
            [
                'document' => $document,
                'staffs' => Staff::all(),
            ]
        );
    }

    public function update(DocumentFormRequest $request, Document $document)
    {
        $data = $this->extractData($document, $request);
        $document->update([
            'staff_id' => $data['staff_id'],
            'file' => $data['file'],
            'type' => $data['type']
        ]);
        return redirect()->route('rh.documents.index');
    }

    public function destroy(Document $document)
    {
        Storage::disk('public')->delete($document->file);
        $document->delete();
        return redirect()->route('rh.documents.index');
    }

    public function download(Document $document)
    {
        return Storage::disk('public')->download($document->file);
    }

    public function preview(Document $document)
    {
        return Storage::disk('public')->response($document->file);
    }

}

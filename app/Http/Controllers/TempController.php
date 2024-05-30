<?php

namespace App\Http\Controllers;

use App\Models\DocModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class TempController extends Controller
{
    //
    public function liste()
    {
        return view('list.index');
    }



    public function add()
    {
        return view('add.index');
    }




    // Affiche la liste de tous les documents
    public function index()
    {
        // Récupère tous les documents depuis la base de données
        $documents = DocModel::all();
        // Retourne la vue avec les documents
        return view('list.index', compact('documents'));
    }

    // Affiche le formulaire de création d'un nouveau document
    public function create()
    {
        return view('add.index');
    }

    // Enregistre un nouveau document dans la base de données
    public function store(Request $request)
    {
        // Valide les données du formulaire
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'publier_le' => 'required|date',
            'publier_par' => 'required|string|max:255',
            'extension' => 'required|in:pdf,docx,xlsx,png,jpg',
            'type_document' => 'required|string|max:255',
            'etat' => 'required|in:publié,non_publié',
            'description' => 'required|string',
            'nombre_vue' => 'required|integer|min:0',
            'fichier' => 'required|file|mimes:pdf,docx,xlsx,png,jpg|max:2048',
        ]);

        // Vérifie si un fichier a été téléchargé
        if ($request->hasFile('fichier')) {
            // Stocke le fichier et récupère le chemin de stockage
            $path = $request->file('fichier')->store('documents');
            // Ajoute le chemin du fichier aux données validées
            $validated['fichier'] = $path;
        }

        // Crée un nouveau document avec les données validées
        DocModel::create($validated);

        // Redirige vers la liste des documents avec un message de succès
        return redirect()->route('documents.index')->with('success', 'Document créé avec succès.');
    }

    // Méthode pour afficher les détails d'un document spécifique
    public function show($id)
    {
        $document = DocModel::findOrFail($id);
        return view('show', compact('document'));
    }

    public function edit($id)
    {
        // Récupérer le document à partir de l'ID fourni
        $document = DocModel::findOrFail($id);

        // Retourne la vue avec le formulaire de modification
        return view('edit.index', compact('document'));
    }

    // Met à jour un document existant dans la base de données
    public function update(Request $request, $id)
    {
        // Récupérer le document à partir de l'ID fourni
        $document = DocModel::findOrFail($id);

        // Valide les données du formulaire
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'publier_le' => 'required|date',
            'publier_par' => 'required|string|max:255',
            'extension' => 'required|in:pdf,docx,xlsx,png,jpg',
            'type_document' => 'required|string|max:255',
            'etat' => 'required|in:publié,non_publié',
            'description' => 'required|string',
            'nombre_vue' => 'required|integer|min:0',
            'fichier' => 'sometimes|file|mimes:pdf,docx,xlsx,png,jpg|max:2048',
        ]);

        // Vérifie si un nouveau fichier a été téléchargé
        if ($request->hasFile('fichier')) {
            // Supprime l'ancien fichier s'il existe
            if ($document->fichier) {
                Storage::delete($document->fichier);
            }
            // Stocke le nouveau fichier et récupère le chemin de stockage
            $path = $request->file('fichier')->store('documents');
            // Ajoute le chemin du nouveau fichier aux données validées
            $validated['fichier'] = $path;
        }

        // Met à jour le document avec les nouvelles données validées
        $document->update($validated);

        // Redirige vers la liste des documents avec un message de succès
        return redirect()->route('documents.index')->with('success', 'Document mis à jour avec succès.');
    }

    // Supprime un document existant de la base de données
    public function destroy($id)
    {
        // Récupérer le document à partir de l'ID fourni
        $document = DocModel::findOrFail($id);

        // Supprimer le fichier associé s'il existe
        if ($document->fichier) {
            Storage::delete($document->fichier);
        }

        // Supprimer le document de la base de données
        $document->delete();

        // Rediriger vers la liste des documents avec un message de succès
        return redirect()->route('documents.index')->with('success', 'Document supprimé avec succès.');
    }
}
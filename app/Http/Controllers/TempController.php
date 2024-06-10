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
        return view('subjects.index');
    }



    public function add()
    {
        return view('subjects.add');
    }




    // Affiche la liste de tous les documents
    public function index()
    {
        // Récupère tous les documents depuis la base de données
        $documents = DocModel::all();
        // Retourne la vue avec les documents
        return view('subjects.index', compact('documents'));
    }

    // Affiche le formulaire de création d'un nouveau document
    public function create()
    {
        return view('subjects.add');
    }

    // Enregistre un nouveau document dans la base de données
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'publier_le' => 'required|date',
            'publier_par' => 'required|string|max:255',
            'extension' => 'required|string|in:pdf,docx,xlsx,png,jpg',
            'type_document' => 'required|string|max:255',
            'etat' => 'required|string|in:publié,non_publié',
            'description' => 'required|string',
            'nombre_vue' => 'required|integer',
            'fichier' => 'required|file|mimes:pdf,docx,xlsx,png,jpg|max:2048'
        ]);

        $document = new DocModel();

        // Mettre à jour les autres champs
        $document->titre = $request->titre;
        $document->publier_le = $request->publier_le;
        $document->publier_par = $request->publier_par;
        $document->extension = $request->extension;
        $document->type_document = $request->type_document;
        $document->etat = $request->etat;
        $document->description = $request->description;
        $document->nombre_vue = $request->nombre_vue;

        // Gestion du fichier
        if ($request->hasFile('fichier')) {
            $file = $request->file('fichier');
            $filename = $document->titre . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('documents', $filename);
            $document->fichier = $path;
        }

        $document->save();

        return redirect()->route('documents.index')
            ->with('success', 'Document ajouté avec succès');
    }


    // Définissez la fonction download dans votre contrôleur
    public function download($id)
    {
        // Recherchez le document correspondant à l'ID fourni
        $document = DocModel::findOrFail($id);

        // Construisez le chemin complet du fichier à télécharger
        // Utilisez storage_path() pour obtenir le chemin du répertoire de stockage de Laravel
        // Concaténez le chemin du répertoire de stockage avec le chemin du fichier stocké dans la base de données
        $filePath = storage_path('app/' . $document->fichier);

        // Obtenez le nom de fichier d'origine à partir du chemin du fichier stocké
        $originalFileName = pathinfo($filePath, PATHINFO_FILENAME);

        // Obtenez l'extension d'origine à partir du nom de fichier d'origine
        $originalExtension = pathinfo($filePath, PATHINFO_EXTENSION);

        // Utilisez la méthode download() de la classe Response pour renvoyer le fichier au client
        // Spécifiez le chemin du fichier et le nom de fichier d'origine à utiliser pour le téléchargement
        return response()->download($filePath, $originalFileName . '.' . $originalExtension);
    }

    // Méthode pour afficher les détails d'un document spécifique
    public function show($id)
    {
        $document = DocModel::findOrFail($id);
        return view('subjects.show', compact('document'));
    }

    public function edit($id)
    {
        // Récupérer le document à partir de l'ID fourni
        $document = DocModel::findOrFail($id);

        // Retourne la vue avec le formulaire de modification
        return view('subjects.edit', compact('document'));
    }

    public function updates()
    {

        return view('subjects.edit');
    }

    // Met à jour un document dans la base de données
    public function update(Request $request, $id)
    {
        // Valide les données du formulaire
        $request->validate([
            'titre' => 'required|string|max:255',
            'publier_le' => 'required|date',
            'publier_par' => 'required|string|max:255',
            'extension' => 'required|string|in:pdf,docx,xlsx,png,jpg',
            'type_document' => 'required|string|max:255',
            'etat' => 'required|string|in:publié,non_publié',
            'description' => 'required|string',
            'nombre_vue' => 'required|integer',
            'fichier' => 'nullable|file|mimes:pdf,docx,xlsx,png,jpg|max:2048' // Le fichier est facultatif
        ]);

        // Recherche le document à mettre à jour
        $document = DocModel::findOrFail($id);

        // Met à jour les champs du document avec les données du formulaire
        $document->titre = $request->titre;
        $document->publier_le = $request->publier_le;
        $document->publier_par = $request->publier_par;
        $document->extension = $request->extension;
        $document->type_document = $request->type_document;
        $document->etat = $request->etat;
        $document->description = $request->description;
        $document->nombre_vue = $request->nombre_vue;

        // Gestion du fichier s'il est fourni dans la demande
        if ($request->hasFile('fichier')) {
            $file = $request->file('fichier');

            // Supprime l'ancien fichier s'il existe
            if ($document->fichier) {
                Storage::delete($document->fichier);
            }

            // Enregistre le nouveau fichier avec le nom original
            $filename = $file->getClientOriginalName();
            $path = $file->storeAs('documents', $filename);
            $document->fichier = $path;
        }

        // Sauvegarde les modifications du document
        $document->save();

        // Redirige l'utilisateur vers la liste des documents avec un message de succès
        return redirect()->route('documents.index')
            ->with('success', 'Document mis à jour avec succès');
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

    public function search(Request $request)
    {
        $query = DocModel::query();

        if ($request->filled('ID')) {
            $query->where('id', $request->ID);
        }

        if ($request->filled('Titre')) {
            $query->where('titre', 'like', '%' . $request->Titre . '%');
        }

        if ($request->filled('annee')) {
            $query->whereYear('publier_le', $request->annee);
        }

        $documents = $query->get();

        return view('subjects.index', compact('documents'));
    }
}

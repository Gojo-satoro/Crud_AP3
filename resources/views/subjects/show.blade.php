<!-- resources/views/documents/show.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Détails du Document</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('documents.index') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('documents.index') }}">Documents</a></li>
                            <li class="breadcrumb-item active">Détails du Document</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">{{ $document->titre }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>ID:</strong> {{ $document->id }}</p>
                                    <p><strong>Publié Le:</strong> {{ $document->publier_le }}</p>
                                    <p><strong>Publié Par:</strong> {{ $document->publier_par }}</p>
                                    <p><strong>Extension:</strong> {{ $document->extension }}</p>
                                    <p><strong>Type de Document:</strong> {{ $document->type_document }}</p>
                                    <p><strong>État:</strong> {{ $document->etat }}</p>
                                    <p><strong>Nombre de Vues:</strong> {{ $document->nombre_vue }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Description:</strong> {{ $document->description }}</p>
                                    @if ($document->extension == 'pdf')
                                        <embed src="{{ asset('storage/documents/' . $document->fichier) }}"
                                            type="application/pdf" width="100%" height="600px" />
                                    @elseif (in_array($document->extension, ['jpg', 'jpeg', 'png', 'gif']))
                                        <img src="{{ asset('storage/adocuments/' . $document->fichier) }}"
                                            alt="{{ $document->titre }}" style="max-width: 100%; height: auto;" />
                                    @else
                                        <p><strong>Fichier:</strong> <a
                                                href="{{ route('documents.download', $document->id) }}">Télécharger</a></p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="{{ route('documents.edit', $document->id) }}" class="btn btn-primary">Modifier</a>
                            <form action="{{ route('documents.destroy', $document->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce document ?');">Supprimer</button>
                            </form>
                            <a href="{{ route('documents.index') }}" class="btn btn-secondary">Retour à la liste</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

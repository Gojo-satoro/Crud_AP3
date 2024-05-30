@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <h2>Modifier un Document</h2>
            <form action="{{ route('documents.update', $document->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-12">
                        <h5 class="form-title"><span>Modifier un Document</span></h5>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group local-forms">
                            <label>Titre <span class="login-danger">*</span></label>
                            <input type="text" class="form-control" name="titre" value="{{ $document->titre }}"
                                required>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group local-forms">
                            <label>Publier Le <span class="login-danger">*</span></label>
                            <input type="date" class="form-control" name="publier_le" value="{{ $document->publier_le }}"
                                required>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group local-forms">
                            <label>Publier Par <span class="login-danger">*</span></label>
                            <input type="text" class="form-control" name="publier_par"
                                value="{{ $document->publier_par }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group local-forms">
                            <label>Extension <span class="login-danger">*</span></label>
                            <select class="form-control" name="extension" required>
                                <option value="pdf" {{ $document->extension == 'pdf' ? 'selected' : '' }}>PDF</option>
                                <option value="docx" {{ $document->extension == 'docx' ? 'selected' : '' }}>DOCX</option>
                                <option value="xlsx" {{ $document->extension == 'xlsx' ? 'selected' : '' }}>XLSX</option>
                                <option value="png" {{ $document->extension == 'png' ? 'selected' : '' }}>PNG</option>
                                <option value="jpg" {{ $document->extension == 'jpg' ? 'selected' : '' }}>JPG</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group local-forms">
                            <label>Type Document <span class="login-danger">*</span></label>
                            <input type="text" class="form-control" name="type_document"
                                value="{{ $document->type_document }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group local-forms">
                            <label>Etat <span class="login-danger">*</span></label>
                            <select class="form-control" name="etat" required>
                                <option value="publié" {{ $document->etat == 'publié' ? 'selected' : '' }}>Publié</option>
                                <option value="non_publié" {{ $document->etat == 'non_publié' ? 'selected' : '' }}>Non
                                    Publié
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group local-forms">
                            <label>Description <span class="login-danger">*</span></label>
                            <textarea class="form-control" name="description" rows="4" required>{{ $document->description }}</textarea>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group local-forms">
                            <label>Nombre de Vues <span class="login-danger">*</span></label>
                            <input type="number" class="form-control" name="nombre_vue"
                                value="{{ $document->nombre_vue }}" required>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6">
                        <div class="form-group local-forms">
                            <label>Fichier <span class="login-danger">*</span></label>
                            <input type="file" class="form-control" name="fichier">
                            @if ($document->fichier)
                                <small>Fichier actuel : <a href="{{ asset($document->fichier) }}"
                                        download>Download</a></small>
                            @endif
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="student-submit">
                            <button type="submit" class="btn btn-primary">Modifier le Document</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

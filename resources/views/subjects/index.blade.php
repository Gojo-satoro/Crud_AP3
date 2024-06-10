@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- page-header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Subjects</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Subjects</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- student-group-form -->
            <div class="student-group-form">
                <form action="{{ route('search') }}" method="GET">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <input type="text" name="ID" class="form-control" placeholder="Search by ID ...">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <input type="text" name="Titre" class="form-control" placeholder="Search by Title ...">
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="form-group">
                                <input type="text" name="annee" class="form-control" placeholder="Search by Year ...">
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="search-student-btn">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- documents table -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="page-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h3 class="page-title">Subjects</h3>
                                    </div>
                                    <div class="col-auto text-end float-end ms-auto download-grp">

                                        <a href="{{ route('add') }}" class="btn btn-primary"><i
                                                class="fas fa-plus"></i></a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table
                                    class="table border-0 star-student table-hover table-center mb-0 datatable table-striped">
                                    <thead class="student-thread">
                                        <tr>
                                            <th>
                                                <div class="form-check check-tables">
                                                    <input class="form-check-input" type="checkbox" value="something">
                                                </div>
                                            </th>
                                            <th>ID</th>
                                            <th>Titre</th>
                                            <th>Publier Le</th>
                                            <th>Publier Par</th>
                                            <th>Extension</th>
                                            <th>Type Document</th>
                                            <th>Etat</th>
                                            <th>Description</th>
                                            <th>Nombre de Vues</th>
                                            <th>Fichier</th>
                                            <th class="text-end">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($documents as $document)
                                            <tr>
                                                <td>
                                                    <div class="form-check check-tables">
                                                        <input class="form-check-input" type="checkbox" value="something">
                                                    </div>
                                                </td>
                                                <td>{{ $document->id }}</td>
                                                <td>
                                                    <h2><a
                                                            href="{{ route('documents.show', $document->id) }}">{{ $document->titre }}</a>
                                                    </h2>
                                                </td>
                                                <td>{{ $document->publier_le }}</td>
                                                <td>{{ $document->publier_par }}</td>
                                                <td>{{ $document->extension }}</td>
                                                <td>{{ $document->type_document }}</td>
                                                <td>{{ $document->etat }}</td>
                                                <td>{{ $document->description }}</td>
                                                <td>{{ $document->nombre_vue }}</td>
                                                <td><a
                                                        href="{{ route('documents.download', $document->id) }}">Télécharger</a>
                                                </td>
                                                <td class="text-end">
                                                    <div class="actions">
                                                        <a href="{{ route('documents.show', $document->id) }}"
                                                            class="btn btn-sm bg-success-light me-2">
                                                            <i class="feather-eye"></i>
                                                        </a>
                                                        <form action="{{ route('documents.edit', $document->id) }}"
                                                            method="GET" enctype="multipart/form-data">
                                                            @csrf
                                                            <button type="submit" class="btn btn-sm bg-danger-light">
                                                                <i class="feather-edit"></i>
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('documents.destroy', $document->id) }}"
                                                            method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm bg-danger-light"
                                                                onclick="event.preventDefault(); if(confirm('Êtes-vous sûr de vouloir supprimer ce document ?')) { this.closest('form').submit(); }">
                                                                <i class="feather-trash-2"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Add Subject</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="subjects.html">Subject</a></li>
                            <li class="breadcrumb-item active">Add Subject</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h5 class="form-title"><span>Ajouter un Nouveau Document</span></h5>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Titre <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" name="titre" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Publier Le <span class="login-danger">*</span></label>
                                            <input type="date" class="form-control" name="publier_le" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Publier Par <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" name="publier_par" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Extension <span class="login-danger">*</span></label>
                                            <select class="form-control" name="extension" required>
                                                <option value="pdf">PDF</option>
                                                <option value="docx">DOCX</option>
                                                <option value="xlsx">XLSX</option>
                                                <option value="png">PNG</option>
                                                <option value="jpg">JPG</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Type Document <span class="login-danger">*</span></label>
                                            <input type="text" class="form-control" name="type_document" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Etat <span class="login-danger">*</span></label>
                                            <select class="form-control" name="etat" required>
                                                <option value="publié">Publié</option>
                                                <option value="non_publié">Non Publié</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group local-forms">
                                            <label>Description <span class="login-danger">*</span></label>
                                            <textarea class="form-control" name="description" rows="4" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Nombre de Vues <span class="login-danger">*</span></label>
                                            <input type="number" class="form-control" name="nombre_vue" required>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="form-group local-forms">
                                            <label>Fichier <span class="login-danger">*</span></label>
                                            <input type="file" class="form-control" name="fichier" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="student-submit">
                                            <button type="submit" class="btn btn-primary">Ajouter le Document</button>
                                        </div>
                                    </div>
                                </div>
                            </form>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
@endsection

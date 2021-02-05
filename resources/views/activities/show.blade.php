@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Activité</h2>
                        </div>
                    </div>
                </div>

                <div class="tab-content">
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="activity_name" class="col-form-label">Nom</label>
                            <input type="text" value="{{$activitie->activities_name}}" class="form-control" id="activity_name" disabled>
                        </div>
                        <div class="form-group col-4">
                            <label for="activity_lang" class="col-form-label">Langue</label>
                        <input type="text" value="{{$activitie->language}}" class="form-control" id="activity_lang" disabled>
                        </div>
                        <div class="form-group col-4">
                            <label for="activity_ressource" class="col-form-label">Ressource</label>
                        <input type="text" value="{{$activitie->activities_ressource}}" class="form-control" id="activity_ressource" disabled>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-4">
                            <label for="dateDebut">Du</label>
                            <input type="text" value="{{$activitie->start_date}}" id="dateDebut" name="start_date"
                                   class="input-inline form-control" disabled/>
                        </div>
                        <div class="form-group col-4">
                            <label for="dateFin">Au</label>
                            <input type="text" value="{{$activitie->end_date}}" id="dateFin" name="end_date"
                                   class="input-inline form-control" disabled/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="user_commentaire">Commentaire élève</label>
                        <textarea id="new_commentaire" class="form-control" name="commentaire" rows="4" maxlength="500" disabled>{{$activitie->user_commentaire}}</textarea>
                        </div>
                        <div class="form-group col-6">
                            <label for="teacher_commentaire">Commentaire professeur</label>
                            <textarea id="teacher_commentaire" class="form-control" name="commentaire" rows="4" maxlength="500" disabled>{{$activitie->teacher_commentaire}}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @can('manage')
                            <a class="btn btn-info" href="{{ route('users.show', $activitie->user_id) }}">Retour</a>
                            <a class="btn btn-primary" href="{{ route('activities.edit',$activitie->id) }}">Editer</a>
                        @else
                            <a class="btn btn-info" href="{{ route('profile') }}">Retour</a>
                            <a class="btn btn-primary" href="{{ route('activities.edit',$activitie->id) }}">Editer</a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

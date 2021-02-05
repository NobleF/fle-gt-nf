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
                    {!! Form::model($activitie, ['method' => 'GET','route' => ['activities.update', $activitie->id]]) !!}
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="activity_name" class="col-form-label">Nom</label>
                                {!! Form::text('activities_name', null, array('placeholder' => 'Nom', 'id' => 'activities_name', 'class' => 'form-control')) !!}
                            </div>
                            <div class="form-group col-4">
                                <label for="activity_lang" class="col-form-label">Langue</label>
                                {!! Form::text('language', null, array('placeholder' => 'Langue', 'id' => 'language', 'class' => 'form-control')) !!}
                            </div>
                            <div class="form-group col-4">
                                <label for="activity_ressource" class="col-form-label">Ressource</label>
                                <!--!! Form::text('ressource', null, array('placeholder' => 'Ressource', 'id' => 'ressource', 'class' => 'form-control')) !!}-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-4">
                                <label for="dateDebut">Du</label>
                                <input type="datetime-local" value="{{$activitie->end_date}}" id="dateDebut" name="start_date"
                                       class="input-inline form-control" data-provide="datepicker" data-format="dd/MM/yyyy"/>
                            </div>
                            <div class="form-group col-4">
                                <label for="dateFin">Au</label>
                                <input type="datetime-local" value="{{$activitie->end_date}}" id="dateFin" name="end_date"
                                       class="input-inline form-control" data-provide="datepicker" data-format="dd/MM/yyyy"/>
                            </div>
                        </div>
                        <div class="row">
                            @can('manage')
                                <div class="form-group col-6">
                                    <label for="user_commentaire">Commentaire élève</label>
                                    {!! Form::textarea('user_commentaire', null, array('id' => 'user_commentaire', 'class' => 'form-control', 'rows' => '4', 'maxlength' => '500')) !!}
                                </div>
                                <div class="form-group col-6">
                                    <label for="teacher_commentaire">Commentaire professeur</label>
                                    {!! Form::textarea('teacher_commentaire', null, array('id' => 'teacher_commentaire', 'class' => 'form-control', 'rows' => '4', 'maxlength' => '500')) !!}
                                </div>
                            @else
                                <div class="form-group col-12">
                                    <label for="user_commentaire">Commentaire élève</label>
                                    {!! Form::textarea('user_commentaire', null, array('id' => 'new_commentaire', 'class' => 'form-control', 'rows' => '4', 'maxlength' => '500')) !!}
                                </div>
                            @endcan
                        </div>
                        <div class="modal-footer">
                            @can('manage')
                                <a class="btn btn-info" href="{{ route('activities.show', $activitie->id) }}">Retour</a>
                                <button type="submit" class="btn btn-primary" id="submitBtn">Modifier</button>
                            @else
                                <a class="btn btn-info" href="{{ route('profile') }}">Retour</a>
                                <button type="submit" class="btn btn-primary" id="submitBtn">Modifier</button>
                            @endcan
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

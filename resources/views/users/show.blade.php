@extends('layouts.app')


@section('content')
    <div class="" style="margin-left: 15%; margin-right: 15%">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>{{ "$user->name $user->lastname" }}</h2>
                            <div class="align-text-top">@lang('fle.manage.user.show.email'){{ $user->email }}</div>
                        </div>
                    </div>
                </div>

                        <div class="pull-right">
                            <a class="btn btn-info" href="{{ route('users.index') }}">@lang('fle.manage.user.show.back')</a>
                            <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">@lang('fle.manage.user.show.edit')</a>
                        </div>


                <ul class="nav nav-tabs">
                    <li class="navbar "><a data-toggle="tab" href="#board">Carnet de bord</a></li>
                    <li class="navbar active"><a data-toggle="tab" href="#previous_upload">Fichiers téléversé</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="board">
                        <h3>Carnet de bord</h3>
                        <form name="form_filtres_carnet_bord" method="post" action="/mes-activites/etudiant"
                              id="formFiltres">

                            <div class="row">
                                <!--Date début-->
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="dateDebutFiltre">Du :</label>
                                        <input type="date" id="dateDebutFiltre" name="dateDebutFiltre"
                                               class="input-inline datetimepicker2 form-control"
                                               data-provide="datepicker" data-format="dd/MM/yyyy" disabled/>
                                    </div>
                                </div>

                                <!--Date fin-->
                                <div class="col-xs65 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="dateFinFiltre">Au :</label>
                                        <div class="input-group">
                                            <input type="date" id="dateFinFiltre" name="dateFinFiltre"
                                                   class="input-inline datetimepicker2 form-control"
                                                   data-provide="datepicker" data-format="dd/MM/yyyy" disabled/>
                                            <div class="input-group-btn">
                                                <button type="submit" id="filterCarnetDeBord" class="btn btn-danger disabled" disabled>Filtrer</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="form-group">
                            <button type="button" id="filterCarnetDeBord" class="btn btn-success" data-toggle="modal" data-target=".add-activity-modal">+ Ajouter une activitée</button>
                        </div>

                        <table class="table" id="table_activites" style="table-layout: auto; width: 100%;">
                            <thead>
                            <tr>
                                <th scope="col">@lang('fle.board.table.title')</th>
                                <th scope="col">@lang('fle.board.table.date.start')</th>
                                <th scope="col">@lang('fle.board.table.date.end')</th>
                                <th scope="col" style="width:140px;">@lang('fle.board.table.date.time')</th>
                                <th scope="col" style="/*width:120px;">@lang('fle.board.table.lang')</th>
                                <th scope="col" style="/*width:350px;">@lang('fle.board.table.commentary.user')</th>
                                <th scope="col" style="/*width:350px;">@lang('fle.board.table.commentary.teacher')</th>
                                <th scope="col" style="width:260px;">@lang('fle.board.table.action')</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($activities as $key => $data)
                                <tr>
                                    <td>{{ $data->activities_name }}</td>
                                    <td>{{ date("d/m/Y H:i", strtotime($data->start_date)) }}</td>
                                    <td>{{ date("d/m/Y H:i", strtotime($data->end_date)) }}</td>
                                    <td>{{ $data->time['day']}}j {{$data->time['hour']}}h {{$data->time['minute']}}min</td>
                                    <td>{{ $data->language }}</td>
                                    @if(strlen($data->user_commentaire) > 100)
                                        <td>{{ substr($data->user_commentaire, 0, 100).' ...' }}</td>
                                    @else
                                        <td>{{ $data->user_commentaire }}</td>
                                    @endif
                                    @if(strlen($data->teacher_commentaire) > 100)
                                        <td>{{ substr($data->teacher_commentaire, 0, 100).' ...' }}</td>
                                    @else
                                        <td>{{ $data->teacher_commentaire }}</td>
                                    @endif
                                    <td>
                                        <a class="btn btn-info" href="{{ route('activities.show', $data->id)}}">@lang('fle.board.table.show')</a>
                                        <a class="btn btn-primary" href="{{ route('activities.edit', $data->id, $user->id) }}">@lang('fle.board.table.edit')</a>
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['activities.destroy', $data->id], 'style' => 'display:inline']) !!}
                                        {!! Form::submit('Supprimer', ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr class="alert-info">
                                <th>Total</th>
                                <th colspan="2"></th>
                                <th>{{$total['day']}}j {{$total['hour']}}h {{$total['minute']}}min</th>
                                <th colspan="4"></th>
                            </tr>
                            </tfoot>
                        </table>

                        <!-- Modal -->

                        <div class="modal fade add-activity-modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">@lang('fle.board.add_activity')</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {!! Form::open(array('route' => 'activities.add','method'=>'POST')) !!}
                                        {!! Form::text('user_id', $user->id, array('id' => 'user_id', 'hidden' => 'true')) !!}
                                        <div class="tab-content">
                                            <div class="row">
                                                <div class="form-group col-4">
                                                    <label for="activity_name" class="col-form-label">@lang('fle.board.modal.nom')</label>
                                                {!! Form::text('activities_name', null, array('placeholder' => __('fle.board.modal.nom'), 'id' => 'activities_name', 'class' => 'form-control')) !!}
                                                <!--<input type="text" class="form-control" id="activity_name">-->
                                                </div>
                                                <div class="form-group col-4">
                                                    <label for="activity_lang" class="col-form-label">@lang('fle.board.modal.language')</label>
                                                {!! Form::text('language', null, array('placeholder' => __('fle.board.modal.language'), 'id' => 'language', 'class' => 'form-control')) !!}
                                                <!--<input type="text" class="form-control" id="activity_lang">-->
                                                </div>
                                                <div class="form-group col-4">
                                                    <label for="activity_ressource" class="col-form-label">@lang('fle.board.modal.ressource')</label>
                                                {!! Form::text('ressource', null, array('placeholder' => __('fle.board.modal.ressource'), 'id' => 'ressource', 'class' => 'form-control')) !!}
                                                <!--<input type="text" class="form-control" id="activity_ressource">-->
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-4">
                                                    <label for="dateDebut">@lang('fle.board.date_debut')</label>
                                                    <input type="datetime-local" id="dateDebut" name="start_date"
                                                           class="input-inline datetimepicker2 form-control"
                                                           data-provide="datepicker" data-format="dd/MM/yyyy"/>
                                                </div>
                                                <div class="form-group col-4">
                                                    <label for="dateFin">@lang('fle.board.date_fin')</label>
                                                    <input type="datetime-local" id="dateFin" name="end_date"
                                                           class="input-inline datetimepicker2 form-control"
                                                           data-provide="datepicker" data-format="dd/MM/yyyy"/>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label for="new_commentaire">@lang('fle.board.modal.commentaire_prof')</label>
                                                {!! Form::textarea('teacher_commentaire', null, array('id' => 'new_commentaire', 'class' => 'form-control', 'rows' => '3', 'maxlength' => '500')) !!}
                                                <!--<textarea id="new_commentaire" class="form-control" name="commentaire" rows="3" maxlength="500"></textarea>-->
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('fle.board.modal.cancel')</button>
                                                <button type="submit" class="btn btn-primary">@lang('fle.board.modal.add')</button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!--/tab-pane-->
                    <div class="tab-pane" id="previous_upload"><!--tab-pane-->
                        <table class="table" id="table_upload">
                            <thead>
                            <tr>
                                <th scope="col">@lang('fle.file.online.board.num')</th>
                                <th scope="col">@lang('fle.file.online.board.name')</th>
                                <th scope="col">@lang('fle.file.online.board.upload_date')</th>
                                <th scope="col">@lang('fle.file.online.board.action')</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($previous_uploads as $key => $upload)
                                <tr>
                                    <th>{{ $key }}</th>
                                    <th>{{ explode('_', $upload->name)[1] }}</th>
                                    <th>{{ $upload->created_at }}</th>
                                    <th>
                                        {!! Form::open(['method' => 'GET', 'route' => ['file.download', $upload->uuid], 'style' => 'display:inline']) !!}
                                        {!! Form::submit(__('fle.file.online.board.download'), ['class' => 'btn btn-info']) !!}
                                        {!! Form::close() !!}

                                        {!! Form::open(['method' => 'DELETE','route' => ['file.destroy', $upload->uuid],'style'=>'display:inline']) !!}
                                        {!! Form::submit(__('fle.file.online.board.delete'), ['class' => 'btn btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </th>
                                </tr>
                        @endforeach

                    </div><!--/tab-pane-->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scrpit')
    <script type="application/javascript">

        //Activity
        $(document).ready(function() {
            $('#dateDebutFiltre').change(function(e) {
                let dateDebutFiltre = document.getElementById("dateDebutFiltre");
                let dateFinFiltre = document.getElementById("dateFinFiltre");
                dateFinFiltre.setAttribute("min", dateDebutFiltre.value);
                if(dateDebutFiltre.value >= dateFinFiltre.value){
                    dateFinFiltre.value = dateDebutFiltre.value
                }
            });

            $('#dateDebut').change(function(e) {
                let dateDebut = document.getElementById("dateDebut");
                let dateFin = document.getElementById("dateFin");
                dateFin.setAttribute("min", dateDebut.value);
                if(dateDebut.value >= dateFin.value){
                    dateFin.value = dateDebut.value
                }
            });
        });
    </script>
@endsection

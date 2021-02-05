@extends('layouts.app')

@section('content')
    <div class="" style="margin-left: 15%; margin-right: 15%">
        <div class="row">
            <div class="col-sm-10">
                <h1>@lang('fle.profile.title')</h1>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="navbar active"><a data-toggle="tab" href="#profile">@lang('fle.profile.layout')</a></li>
                    <li class="navbar "><a data-toggle="tab" href="#board">@lang('fle.board.layout')</a></li>
                    <li class="navbar "><a data-toggle="tab" href="#calendarPane">@lang('fle.calendar.name')</a></li>
                    <li class="navbar "><a data-toggle="tab" href="#upload">@lang('fle.file.upload.layout')</a></li>
                    <li class="navbar "><a data-toggle="tab" href="#previous_upload">@lang('fle.file.online.layout')</a>
                    </li>
                </ul>


                <div class="tab-content">
                    <div class="tab-pane" id="profile">
                        <h3>Mes informations personnels</h3>
                        {!! Form::model($user, ['method' => 'PATCH', 'route' => ['profile.update']]) !!}
                        <div class="row">
                            <!--Nom-->
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <strong>Nom :</strong>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">#</span>
                                    </div>
                                    {!! Form::text('lastname', null, ['placeholder' => 'Nom', 'class' => 'form-control'])
                                    !!}
                                </div>
                            </div>
                            <!--Prénom-->
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <strong>Prénom :</strong>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">#</span>
                                    </div>
                                    {!! Form::text('name', null, ['placeholder' => 'Prénom', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <!--Email-->
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <strong>Email :</strong>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">@</span>
                                    </div>
                                    {!! Form::text('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) !!}
                                    <!--<div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">@univ-lorraine.fr</span>
                                </div>-->
                                </div>
                            </div>

                            {{-- Rôle --}}
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <strong>Vous êtes :</strong>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">#</span>
                                    </div>
                                    {!! Form::select('role', ['0' => __('auth.role.etudiant'), '1' => __('auth.role.prof')])
                                    !!}
                                    <!--<div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2">@univ-lorraine.fr</span>
                                </div>-->
                                </div>
                            </div>
                            <!--Password-->
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <strong>Modifier le mot de passe :</strong>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        {!! Form::password('password', ['placeholder' => 'Nouveau mot de passe', 'class' =>
                                        'form-control']) !!}
                                        <div class="feedback">Laissez vide pour ne pas modifier</div>

                                    </div>

                                    <div class="form-group col-md-6">
                                        {!! Form::password('confirm-password', ['placeholder' => 'Confirmation du nouveau
                                        mot de passe', 'class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <a class="btn btn-danger" href="{{ route('users.index') }}">Annuler</a>
                                <button type="submit" class="btn btn-primary" id="submitBtn">Modifier</button>
                            </div>
                            {!! Form::close() !!}
                        </div>

                    </div>
                    <!--/tab-pane-->
                    <div class="tab-pane active" id="board">
                        <h3>@lang('fle.board.layout')</h3>
                        <form name="form_filtres_carnet_bord" method="post" action="/mes-activites/etudiant"
                            id="formFiltres">

                            <div class="row">
                                <!--Date début-->
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="dateDebutFiltre">@lang('fle.board.date_debut')</label>
                                        <input type="date" id="dateDebutFiltre" name="dateDebutFiltre"
                                            class="input-inline datetimepicker2 form-control" data-provide="datepicker"
                                            data-format="dd/MM/yyyy" disabled />
                                    </div>
                                </div>

                                <!--Date fin-->
                                <div class="col-xs65 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <label for="dateFinFiltre">@lang('fle.board.date_fin')</label>
                                        <div class="input-group">
                                            <input type="date" id="dateFinFiltre" name="dateFinFiltre"
                                                class="input-inline datetimepicker2 form-control" data-provide="datepicker"
                                                data-format="dd/MM/yyyy" disabled />
                                            <div class="input-group-btn">
                                                <button type="submit" id="filterCarnetDeBord"
                                                    class="btn btn-danger disabled"
                                                    disabled>@lang('fle.board.btn_filter')</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="form-group">
                            <button type="button" id="filterCarnetDeBord" class="btn btn-success" data-toggle="modal"
                                data-target=".add-activity-modal">@lang('fle.board.add_activity')</button>
                        </div>

                        <input type="hidden" id="authRole" value="{{ Auth::user()->role }}">
                        <input type="hidden" id="authId" value="{{ Auth::id() }}">

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
                                @foreach ($activities as $key => $data)
                                    <tr>
                                        <td>{{ $data->activities_name }}</td>
                                        <td>{{ date('d/m/Y H:i', strtotime($data->start_date)) }}</td>
                                        <td>{{ date('d/m/Y H:i', strtotime($data->end_date)) }}</td>
                                        <td>{{ $data->time['day'] }}j {{ $data->time['hour'] }}h
                                            {{ $data->time['minute'] }}min</td>
                                        <td>{{ $data->language }}</td>
                                        @if (strlen($data->user_commentaire) > 100)
                                            <td>{{ substr($data->user_commentaire, 0, 100) . ' ...' }}</td>
                                        @else
                                            <td>{{ $data->user_commentaire }}</td>
                                        @endif
                                        @if (strlen($data->teacher_commentaire) > 100)
                                            <td>{{ substr($data->teacher_commentaire, 0, 100) . ' ...' }}</td>
                                        @else
                                            <td>{{ $data->teacher_commentaire }}</td>
                                        @endif
                                        <td>
                                            <a class="btn btn-info"
                                                href="{{ route('activities.show', $data->id) }}">@lang('fle.board.table.show')</a>
                                            <a class="btn btn-primary"
                                                href="{{ route('activities.edit', $data->id) }}">@lang('fle.board.table.edit')</a>
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['activities.destroy',
                                            $data->id], 'style' => 'display:inline']) !!}
                                            {!! Form::submit(__('fle.board.table.delete'), ['class' => 'btn btn-danger'])
                                            !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="alert-info">
                                    <th>Total</th>
                                    <th colspan="2"></th>
                                    <th>{{ $total['day'] }}j {{ $total['hour'] }}h {{ $total['minute'] }}min</th>
                                    <th colspan="4"></th>
                                </tr>
                            </tfoot>
                        </table>

                        <!-- Modal -->

                        <div class="modal fade add-activity-modal" tabindex="-1" role="dialog"
                            aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">@lang('fle.board.add_activity')</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        {!! Form::open(['route' => 'activities.add', 'method' => 'POST']) !!}
                                        {!! Form::text('user_id', $user->id, ['id' => 'user_id', 'hidden' => 'true']) !!}
                                        <div class="tab-content">
                                            <div class="row">
                                                <div class="form-group col-4">
                                                    <label for="activity_name"
                                                        class="col-form-label">@lang('fle.board.modal.nom')</label>
                                                    {!! Form::text('activities_name', null, ['placeholder' =>
                                                    __('fle.board.modal.nom'), 'id' => 'activities_name', 'class' =>
                                                    'form-control']) !!}
                                                    <!--<input type="text" class="form-control" id="activity_name">-->
                                                </div>
                                                <div class="form-group col-4">
                                                    <label for="activity_lang"
                                                        class="col-form-label">@lang('fle.board.modal.language')</label>
                                                    {!! Form::text('language', null, ['placeholder' =>
                                                    __('fle.board.modal.language'), 'id' => 'language', 'class' =>
                                                    'form-control']) !!}
                                                    <!--<input type="text" class="form-control" id="activity_lang">-->
                                                </div>
                                                <div class="form-group col-4">
                                                    <label for="activity_ressource"
                                                        class="col-form-label">@lang('fle.board.modal.ressource')</label>
                                                    {!! Form::text('ressource', null, ['placeholder' =>
                                                    __('fle.board.modal.ressource'), 'id' => 'ressource', 'class' =>
                                                    'form-control']) !!}
                                                    <!--<input type="text" class="form-control" id="activity_ressource">-->
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-4">
                                                    <label for="dateDebut">@lang('fle.board.date_debut')</label>
                                                    <input type="datetime-local" id="dateDebut" name="start_date"
                                                        class="input-inline datetimepicker2 form-control"
                                                        data-provide="datepicker" data-format="dd/MM/yyyy" />
                                                </div>
                                                <div class="form-group col-4">
                                                    <label for="dateFin">@lang('fle.board.date_fin')</label>
                                                    <input type="datetime-local" id="dateFin" name="end_date"
                                                        class="input-inline datetimepicker2 form-control"
                                                        data-provide="datepicker" data-format="dd/MM/yyyy" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-12">
                                                    <label
                                                        for="new_commentaire">@lang('fle.board.modal.commentaire')</label>
                                                    {!! Form::textarea('user_commentaire', null, ['id' => 'new_commentaire',
                                                    'class' => 'form-control', 'rows' => '3', 'maxlength' => '500']) !!}
                                                    <!--<textarea id="new_commentaire" class="form-control" name="commentaire" rows="3" maxlength="500"></textarea>-->
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">@lang('fle.board.modal.cancel')</button>
                                                <button type="submit"
                                                    class="btn btn-primary">@lang('fle.board.modal.add')</button>
                                            </div>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/tab-pane-->
                    <div class="tab-pane" id="upload">
                        <h3>@lang('fle.file.upload.title')</h3>
                        <!--UPLOAD-->
                        <form method="post" action="{{ url('file') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">@lang('fle.file.upload.load_file')</button>
                                <button class="btn btn-success" id="addFileProfil"
                                    type="button">@lang('fle.file.upload.add_file')</button>
                            </div>

                            <div class="input-group control-group increment">
                                <input type="file" name="filename[]" class="form-control">
                            </div>

                            <div class="clone-add-file hide" hidden>
                                <div class="control-group input-group" style="margin-top:10px">
                                    <input type="file" name="filename[]" class="form-control">
                                    <div class="input-group-btn">
                                        <button class="btn btn-danger removeFile"
                                            type="button">@lang('fle.file.upload.del_file')</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <!--/tab-pane-->
                    <div class="tab-pane" id="calendarPane" style="padding-top: 20px; position: relative;">
                        <div id="dialog-form" title="Ajouter un événement">
                            <p class="validateTips">Tous les champs sont requis.</p>

                            <form>
                                <fieldset>
                                    <label for="name" style="margin-bottom: 0; margin-top: 0.5rem;">Nom :</label>
                                    <br>
                                    <input type="text" name="name" id="name">
                                    <br>
                                    <label for="description" style="margin-bottom: 0; margin-top: 0.5rem;">Description :</label>
                                    <textarea name="description" id="description" cols="30" rows="5"></textarea>
                                    <label for="start" style="margin-bottom: 0; margin-top: 0.5rem;">Date de début :</label>
                                    <input type="text" id="start" name="start" class="datepicker">
                                    <br>
                                    <label for="starttime" style="margin-bottom: 0; margin-top: 0.5rem;">Heure de début :</label>
                                    <div id="starttime">
                                        <select name="startheures" id="startheures">
                                            @for($i = 0; $i < 24; $i++)
                                                @if($i < 10)
                                                    <option value="0{{ $i }}">0{{ $i }}</option>
                                                @else
                                                    @if($i == 12)
                                                        <option value="{{ $i }}" selected>{{ $i }}</option>
                                                    @else
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endif
                                                @endif
                                            @endfor
                                        </select>
                                        h
                                        <select name="startminutes" id="startminutes">
                                            @for($i = 0; $i < 60; $i++)
                                                @if($i < 10)
                                                    <option value="0{{ $i }}">0{{ $i }}</option>
                                                @else
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endif
                                            @endfor
                                        </select>
                                        min
                                    </div>
                                    <label for="end" style="margin-bottom: 0; margin-top: 0.5rem;">Durée :</label>
                                    <div id="end">
                                        <input type="text" name="endjours" id="endjours" style="width: 50px;">
                                        j
                                        <input type="text" name="endheures" id="endheures" style="width: 50px;">
                                        h
                                        <input type="text" name="endminutes" id="endminutes" style="width: 50px;">
                                        min
                                    </div>
                                    <label for="places" style="margin-bottom: 0; margin-top: 0.5rem;">Nombre de places total :</label>
                                    <input type="text" id="places" name="places">

                                    <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
                                </fieldset>
                            </form>
                        </div>

                        @if(Auth::user()->role == 0)
                            <div id="dialog-form-click" title="Modifier un événement">
                                <form>
                                    <fieldset>
                                        <input type="hidden" id="eventId" name="eventId">
                                        <label for="nameEdit" style="margin-bottom: 0; margin-top: 0.5rem;">Nom :</label>
                                        <br>
                                        <input type="text" name="nameEdit" id="nameEdit" readonly>
                                        <br>
                                        <label for="descriptionEdit" style="margin-bottom: 0; margin-top: 0.5rem;">Description :</label>
                                        <textarea name="descriptionEdit" id="descriptionEdit" cols="30" rows="5" readonly></textarea>
                                        <label for="startEdit" style="margin-bottom: 0; margin-top: 0.5rem;">Date de début :</label>
                                        <input type="text" id="startEdit" name="startEdit" readonly>
                                        <br>
                                        <label for="starttimeEdit" style="margin-bottom: 0; margin-top: 0.5rem;">Heure de début :</label>
                                        <div id="starttimeEdit">
                                            <select name="startheuresEdit" id="startheuresEdit" readonly>
                                                @for($i = 0; $i < 24; $i++)
                                                    @if($i < 10)
                                                        <option value="0{{ $i }}" disabled>0{{ $i }}</option>
                                                    @else
                                                        @if($i == 12)
                                                            <option value="{{ $i }}" disabled>{{ $i }}</option>
                                                        @else
                                                            <option value="{{ $i }}" disabled>{{ $i }}</option>
                                                        @endif
                                                    @endif
                                                @endfor
                                            </select>
                                            h
                                            <select name="startminutesEdit" id="startminutesEdit" readonly>
                                                @for($i = 0; $i < 60; $i++)
                                                    @if($i < 10)
                                                        <option value="0{{ $i }}" disabled>0{{ $i }}</option>
                                                    @else
                                                        <option value="{{ $i }}" disabled>{{ $i }}</option>
                                                    @endif
                                                @endfor
                                            </select>
                                            min
                                        </div>
                                        <label for="endEdit" style="margin-bottom: 0; margin-top: 0.5rem;">Durée :</label>
                                        <div id="endEdit">
                                            <input type="text" name="endjoursEdit" id="endjoursEdit" style="width: 50px;" readonly>
                                            j
                                            <input type="text" name="endheuresEdit" id="endheuresEdit" style="width: 50px;" readonly>
                                            h
                                            <input type="text" name="endminutesEdit" id="endminutesEdit" style="width: 50px;" readonly>
                                            min
                                        </div>
                                        <label for="placesEdit" style="margin-bottom: 0; margin-top: 0.5rem;">Nombre de places total :</label>
                                        <input type="text" id="placesEdit" name="placesEdit" readonly>

                                        <label for="placesRemEdit" style="margin-bottom: 0; margin-top: 0.5rem;">Nombre de places restantes :</label>
                                        <input type="text" id="placesRemEdit" name="placesRemEdit" readonly>

                                        <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
                                    </fieldset>
                                </form>
                            </div>
                        @elseif(Auth::user()->role == 1)
                            <div id="dialog-form-click" title="Modifier un événement">
                                <form>
                                    <fieldset>
                                        <input type="hidden" id="eventId" name="eventId">
                                        <label for="nameEdit" style="margin-bottom: 0; margin-top: 0.5rem;">Nom :</label>
                                        <br>
                                        <input type="text" name="nameEdit" id="nameEdit">
                                        <br>
                                        <label for="descriptionEdit" style="margin-bottom: 0; margin-top: 0.5rem;">Description :</label>
                                        <textarea name="descriptionEdit" id="descriptionEdit" cols="30" rows="5"></textarea>
                                        <label for="startEdit" style="margin-bottom: 0; margin-top: 0.5rem;">Date de début :</label>
                                        <input type="text" id="startEdit" name="startEdit" class="datepicker">
                                        <br>
                                        <label for="starttimeEdit" style="margin-bottom: 0; margin-top: 0.5rem;">Heure de début :</label>
                                        <div id="starttimeEdit">
                                            <select name="startheuresEdit" id="startheuresEdit">
                                                @for($i = 0; $i < 24; $i++)
                                                    @if($i < 10)
                                                        <option value="0{{ $i }}">0{{ $i }}</option>
                                                    @else
                                                        @if($i == 12)
                                                            <option value="{{ $i }}" selected>{{ $i }}</option>
                                                        @else
                                                            <option value="{{ $i }}">{{ $i }}</option>
                                                        @endif
                                                    @endif
                                                @endfor
                                            </select>
                                            h
                                            <select name="startminutesEdit" id="startminutesEdit">
                                                @for($i = 0; $i < 60; $i++)
                                                    @if($i < 10)
                                                        <option value="0{{ $i }}">0{{ $i }}</option>
                                                    @else
                                                        <option value="{{ $i }}">{{ $i }}</option>
                                                    @endif
                                                @endfor
                                            </select>
                                            min
                                        </div>
                                        <label for="endEdit" style="margin-bottom: 0; margin-top: 0.5rem;">Durée :</label>
                                        <div id="endEdit">
                                            <input type="text" name="endjoursEdit" id="endjoursEdit" style="width: 50px;">
                                            j
                                            <input type="text" name="endheuresEdit" id="endheuresEdit" style="width: 50px;">
                                            h
                                            <input type="text" name="endminutesEdit" id="endminutesEdit" style="width: 50px;">
                                            min
                                        </div>
                                        <label for="placesEdit" style="margin-bottom: 0; margin-top: 0.5rem;">Nombre de places total :</label>
                                        <input type="text" id="placesEdit" name="placesEdit">

                                        <label for="placesRemEdit" style="margin-bottom: 0; margin-top: 0.5rem;">Nombre de places restantes :</label>
                                        <input type="text" id="placesRemEdit" name="placesRemEdit" readonly>

                                        <input type="submit" tabindex="-1" style="position:absolute; top:-1000px">
                                    </fieldset>
                                </form>
                            </div>
                        @endif

                        @if(Auth::user()->role == 1)
                            <button class="btn btn-primary" id="test" style="margin-left: 50%; transform: translateX(-50%); padding-top: 7px; padding-bottom: 7px;">Ajouter un événement</button>
                            <hr style="margin-top: 20px; margin-bottom: 20px;">
                        @endif

                        <!--CALENDRIER-->
                        {{-- <h3>@lang('fle.calendar.name')</h3>
                        <hr> --}}

                        {{-- <h4>@lang('event.add')</h4>
                        <hr> --}}
                        {{-- <form action="/fullcalendar/create" method="POST">
                            <div class="form-group">
                                <label for="eventName">@lang('event.name')</label>
                                <input type="text" class="form-control" id="eventName">
                            </div> --}}

                            {{-- <div class="form-group"> --}}
                                {{-- <label for="eventStart">@lang('event.dates.start')</label> --}}
                                {{-- <div class="eventDatePicker">
                                    <div id="eventStart" class="col-6" style="display: flex; align-items: center">
                                        <select name="eventStartDay" id="eventStartDay">
                                            @for($i = 1; $i <= 31; $i++)
                                                <option value="{{ $i < 10 ? '0'.$i : $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                        <select name="eventStartMonth" id="eventStartMonth">
                                            <option value="01">@lang('event.dates.mois.jan')</option>
                                            <option value="02">@lang('event.dates.mois.feb')</option>
                                            <option value="03">@lang('event.dates.mois.mar')</option>
                                            <option value="04">@lang('event.dates.mois.apr')</option>
                                            <option value="05">@lang('event.dates.mois.may')</option>
                                            <option value="06">@lang('event.dates.mois.jun')</option>
                                            <option value="07">@lang('event.dates.mois.jul')</option>
                                            <option value="08">@lang('event.dates.mois.aug')</option>
                                            <option value="09">@lang('event.dates.mois.sep')</option>
                                            <option value="10">@lang('event.dates.mois.oct')</option>
                                            <option value="11">@lang('event.dates.mois.nov')</option>
                                            <option value="12">@lang('event.dates.mois.dec')</option>
                                        </select>
                                        <select name="eventStartYear" id="eventStartYear">
                                            @for($i = intval(date('Y')); $i < intval(date('Y')) + 5; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>

                                        <div class="input-group" id="datetimepicker">
                                            <input type="text" class="form-control">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-calendar-date" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                                        <path d="M6.445 11.688V6.354h-.633A12.6 12.6 0 0 0 4.5 7.16v.695c.375-.257.969-.62 1.258-.777h.012v4.61h.675zm1.188-1.305c.047.64.594 1.406 1.703 1.406 1.258 0 2-1.066 2-2.871 0-1.934-.781-2.668-1.953-2.668-.926 0-1.797.672-1.797 1.809 0 1.16.824 1.77 1.676 1.77.746 0 1.23-.376 1.383-.79h.027c-.004 1.316-.461 2.164-1.305 2.164-.664 0-1.008-.45-1.05-.82h-.684zm2.953-2.317c0 .696-.559 1.18-1.184 1.18-.601 0-1.144-.383-1.144-1.2 0-.823.582-1.21 1.168-1.21.633 0 1.16.398 1.16 1.23z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="eventEnd" class="col-6"></div>
                                </div> --}}
                            {{-- </div> --}}
                        {{-- </form> --}}

                        {{-- @if (Auth::User()->role)
                            <p>Test</p>
                            @else
                            <p>Test 2</p>
                        @endif --}}
                        <div class="response"></div>
                        <div id="calendar"></div>
                    </div>
                    <div class="tab-pane" id="previous_upload">
                        <!--tab-pane-->
                        <h3>@lang('fle.file.online.title')</h3>
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

                                @foreach ($previous_uploads as $key => $upload)
                                    <tr>
                                        <th>{{ $key }}</th>
                                        <th>{{ explode('_', $upload->name)[1] }}</th>
                                        <th>{{ $upload->created_at }}</th>
                                        <th>
                                            {!! Form::open(['method' => 'GET', 'route' => ['file.download', $upload->uuid],
                                            'style' => 'display:inline']) !!}
                                            {!! Form::submit(__('fle.file.online.board.download'), ['class' => 'btn
                                            btn-info']) !!}
                                            {!! Form::close() !!}

                                            {!! Form::open(['method' => 'DELETE', 'route' => ['file.destroy',
                                            $upload->uuid], 'style' => 'display:inline']) !!}
                                            {!! Form::submit(__('fle.file.online.board.delete'), ['class' => 'btn
                                            btn-danger']) !!}
                                            {!! Form::close() !!}
                                        </th>
                                    </tr>
                                @endforeach
                    </div>
                    <!--/tab-pane-->
                </div>
            </div>
            <!--/tab-content-->

        </div>
        <!--/col-9-->
    </div>
    <!--/row-->


@endsection



@section('script')
    <script type="application/javascript">
        //Activity
        $(document).ready(function() {
            $('#dateDebutFiltre').change(function(e) {
                let dateDebutFiltre = document.getElementById("dateDebutFiltre");
                let dateFinFiltre = document.getElementById("dateFinFiltre");
                dateFinFiltre.setAttribute("min", dateDebutFiltre.value);
                if (dateDebutFiltre.value >= dateFinFiltre.value) {
                    dateFinFiltre.value = dateDebutFiltre.value
                }
            });

            $('#dateDebut').change(function(e) {
                let dateDebut = document.getElementById("dateDebut");
                let dateFin = document.getElementById("dateFin");
                dateFin.setAttribute("min", dateDebut.value);
                if (dateDebut.value >= dateFin.value) {
                    dateFin.value = dateDebut.value
                }
            });
        });
        //Fileupload
        $(document).ready(function() {

            $("#addFileProfil").click(function() {
                var html = $(".clone-add-file").html();
                $(".increment").after(html);
            });

            $("body").on("click", ".removeFile", function() {
                $(this).parents(".control-group").remove();
            });

        });

    </script>

    <script src="{{ asset('js/fullcalendar_fr.js') }}"></script>

    {{-- SCRIPT CALENDRIER --}}
    <script>
        $(document).ready(function () {
            var SITEURL = "{{url('/')}}/";

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var calendar = $('#calendar').fullCalendar({
                editable: true,
                events: SITEURL + "fullcalendar",
                displayEventTime: true,
                editable: true,
                eventRender: function (event, element, view) {
                    if (event.allDay === 'true') {
                        event.allDay = true;
                    } else {
                        event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                select: function (start, end, allDay) {
                },
                eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    console.log(event);
                    $.ajax({
                        url: SITEURL + 'fullcalendar/update',
                        data: {title: event.title, start: start, end: end, id: event.id, places: event.places, placesRestantes: event.placesRestantes, description: event.description},
                        type: "POST",
                        success: function (response) {
                            displayMessage("Updated Successfully");
                        }
                    });
                },
                eventClick: function (event) {
                    var userRole = parseInt($("#authRole").val());
                    dialog = $( "#dialog-form-click" ).dialog();
                    $("#eventId").val(event.id);
                    $.ajax({
                        url: SITEURL + 'fullcalendar/' + event.id,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function(data) {
                            var isSub = data[1];
                            data = data[0][0];
                            console.log(isSub);
                            var title = data.title;
                            var places = data.places;
                            var placesRestantes = data.placesRestantes;

                            var debut_arr = data.start.split(' ');
                            debut_arr[0] = debut_arr[0].split('-').reverse().join('/');

                            debut_arr[1] = debut_arr[1].split(':');
                            debut_arr[1].splice(2, 1);

                            var startDate = new Date(data.start);
                            var endDate = new Date(data.end);

                            var diff = (endDate.getTime() - startDate.getTime()) / 1000;

                            var deltaJours = Math.floor(diff / 86400);
                            diff = diff - (deltaJours * 86400);

                            var deltaHeures = Math.floor(diff / 3600);
                            diff = diff - (deltaHeures * 3600);

                            var deltaMinutes = Math.floor(diff / 60);
                            diff = diff - (deltaMinutes * 60);

                            var descrip = data.description;

                            $('#nameEdit').val(title);
                            $('#startEdit').val(debut_arr[0]);
                            $(`#startheuresEdit option[value="${debut_arr[1][0]}"]`).prop('selected', true);
                            $(`#startminutesEdit option[value="${debut_arr[1][1]}"]`).prop('selected', true);
                            $('#endjoursEdit').val(deltaJours);
                            $('#endheuresEdit').val(deltaHeures);
                            $('#endminutesEdit').val(deltaMinutes);
                            $('#placesEdit').val(places);
                            $('#descriptionEdit').val(descrip);
                            $('#placesRemEdit').val(placesRestantes);

                            var role = parseInt($("#authRole").val());
                            console.log(role);

                            if(role == 0) {
                                var dialog, form;
                                var name = $("#nameEdit");
                                var start = $("#startEdit");
                                var startheures = $("#startheuresEdit");
                                var startminutes = $("#startminutesEdit");
                                var endjours = $("#endjoursEdit");
                                var endheures = $("#endheuresEdit");
                                var endminutes = $("#endminutesEdit");
                                var places = $("#placesEdit");
                                var description = $("#descriptionEdit");
                                var allFields = $([]).add(name).add(start).add(startheures).add(startminutes).add(endjours).add(endheures).add(endminutes).add(places).add(description);
                                var tips = $(".validateTips");


                                if(isSub) {
                                    dialog = $( "#dialog-form-click" ).dialog({
                                        autoOpen: false,
                                        height: 660,
                                        width: 350,
                                        modal: true,
                                        resizable: false,
                                        buttons: {
                                            "Se désinscrire": unsignEvent,
                                            "Fermer": function() {
                                                dialog.dialog("close");
                                            },
                                        },
                                        close: function() {
                                            form[ 0 ].reset();
                                            allFields.removeClass( "ui-state-error" );
                                        }
                                    });
                                }

                                else {
                                    dialog = $( "#dialog-form-click" ).dialog({
                                        autoOpen: false,
                                        height: 660,
                                        width: 350,
                                        modal: true,
                                        resizable: false,
                                        buttons: {
                                            "S'inscrire": signupEvent,
                                            "Fermer": function() {
                                                dialog.dialog("close");
                                            },
                                        },
                                        close: function() {
                                            form[ 0 ].reset();
                                            allFields.removeClass( "ui-state-error" );
                                        }
                                    });
                                }

                                form = dialog.find( "form" ).on( "submit", function( event ) {
                                    event.preventDefault();
                                    addUser();
                                });
                            }

                            else if(role == 1) {
                                dialog = $('#dialog-form-click').dialog();
                            }

                            dialog.dialog("open");

                        }
                    });
                }
            });

        });

        function displayMessage(message) {
            $(".response").html("<div class='success'>"+message+"</div>");
            setInterval(function() { $(".success").fadeOut(); }, 1000);
        }
    </script>

    <script>
        $(function() {
            $('.datepicker').datepicker({
                minDate: 0
            });
        });
    </script>

    <script>
        $(".ui-dialog-buttonset")

        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2)
                month = '0' + month;
            if (day.length < 2)
                day = '0' + day;

            return [year, month, day].join('-');
        }

        function isNumeric(str) {
            if(typeof str != "string") return false;
            return !isNaN(str) && !isNaN(parseFloat(str));
        }



        $(function() {
            var dialog, form;
            var name = $("#name");
            var start = $("#start");
            var startheures = $("#startheures");
            var startminutes = $("#startminutes");
            var endjours = $("#endjours");
            var endheures = $("#endheures");
            var endminutes = $("#endminutes");
            var places = $("#places");
            var description = $("#description");
            var allFields = $([]).add(name).add(start).add(startheures).add(startminutes).add(endjours).add(endheures).add(endminutes).add(places).add(description);
            var tips = $(".validateTips");

            function addEvent() {
                var valid = true;
                allFields.removeClass("ui-state-error");

                valid = valid && name.val().length > 0;
                // valid = valid && (parseInt(startheures.val()) > 0 || parseInt(startminutes.val()) > 0);
                valid = valid && isNumeric(startheures.val()) && isNumeric(startminutes.val()) && isNumeric(endjours.val()) && isNumeric(endheures.val()) && isNumeric(endminutes.val())
                valid = valid && (parseInt(endjours.val()) > 0 || parseInt(endheures.val()) > 0 || parseInt(endminutes.val()) > 0);
                valid = valid && isNumeric(places.val());
                valid = valid && parseInt(places.val()) > 0;
                valid = valid && parseInt(endjours.val()) >= 0 && parseInt(endheures.val()) >= 0 && parseInt(endminutes.val()) >= 0;

                if(valid) {
                    var finalName = name.val();

                    var tmpStart = start.val().split('/');
                    tmpStart = tmpStart.map(x => parseInt(x));
                    var finalStart = `${tmpStart[2]}-${tmpStart[1]}-${tmpStart[0]} ${startheures.val()}:${startminutes.val()}:00`;

                    var startDate = new Date(tmpStart[2], tmpStart[1] - 1, tmpStart[0], parseInt(startheures.val()), parseInt(startminutes.val()));

                    var endDate = new Date(startDate.getTime() + parseInt(endjours.val()) * 24 * 60 * 60 * 1000);
                    endDate = new Date(endDate.getTime() + parseInt(endheures.val()) * 60 * 60 * 1000);
                    endDate = new Date(endDate.getTime() + parseInt(endminutes.val()) * 60 * 1000);

                    console.log(endDate.getMonth());
                    var finalEnd = `${endDate.getFullYear()}-${endDate.getMonth() + 1 < 10 ? "0" + (endDate.getMonth() + 1) : endDate.getMonth() + 1}-${endDate.getDate() < 10 ? "0" + endDate.getDate() : endDate.getDate()} `;
                    finalEnd = finalEnd + `${endDate.getHours() < 10 ? "0" + endDate.getHours() : endDate.getHours()}:${endDate.getMinutes() < 10 ? "0" + endDate.getMinutes() : endDate.getMinutes()}:00`;

                    var finalPlaces = parseInt(places.val());

                    var finalDescription = description.val();

                    var SITEURL = "{{url('/')}}/";

                    $.ajax({
                        url: SITEURL + "fullcalendar/create",
                        data: {title: finalName, start: finalStart, end: finalEnd, places: finalPlaces, placesRestantes: finalPlaces, description: finalDescription},
                        type: "POST",
                        success: function (data) {
                            displayMessage("Added Successfully");
                        }
                    });

                    calendar = $("#calendar").fullCalendar();

                    // calendar.fullCalendar('renderEvent',
                    // {
                    //     title: finalName,
                    //     start: finalStart,
                    //     end: finalEnd,
                    // },
                    // true);

                    var dialog = $("#dialog-form").dialog();
                    dialog.dialog("close");

                    $('#calendar').fullCalendar('refetchEvents');
                    $('#calendar').fullCalendar('rerenderEvents');
                }
                // console.log(finalStart);
            }

            dialog = $( "#dialog-form" ).dialog({
                autoOpen: false,
                height: 650,
                width: 350,
                modal: true,
                resizable: false,
                buttons: {
                    "Créer": addEvent,
                    "Annuler": function() {
                        dialog.dialog("close");
                    },
                },
                close: function() {
                    form[ 0 ].reset();
                    allFields.removeClass( "ui-state-error" );
                }
                });

                $( "#test" ).button().on( "click", function() {
                dialog.dialog( "open" );
            });

            form = dialog.find( "form" ).on( "submit", function( event ) {
                event.preventDefault();
                addUser();
            });
        });
    </script>

    <script>
        function signupEvent() {
            var SITEURL = "{{url('/')}}/";
            $.ajax({
                url: SITEURL + "eventSub",
                data: {studentId: parseInt($("#authId").val()), eventId: parseInt($("#eventId").val())},
                type: "POST",
                success: function (data) {
                    console.log("Ajouté avec succès");

                    var dialog = $("#dialog-form-click").dialog();
                    dialog.dialog("close");
                }
            });
        }

        function unsignEvent() {
            var SITEURL = "{{url('/')}}/";
            $.ajax({
                url: SITEURL + "eventUnsub",
                data: {studentId: parseInt($("#authId").val()), eventId: parseInt($("#eventId").val())},
                type: "POST",
                success: function (data) {
                    console.log("Désinscrit avec succès");

                    var dialog = $("#dialog-form-click").dialog();
                    dialog.dialog("close");
                }
            });
        }

        $(function() {
            var dialog, form;
            var name = $("#nameEdit");
            var start = $("#startEdit");
            var startheures = $("#startheuresEdit");
            var startminutes = $("#startminutesEdit");
            var endjours = $("#endjoursEdit");
            var endheures = $("#endheuresEdit");
            var endminutes = $("#endminutesEdit");
            var places = $("#placesEdit");
            var placesRestantes = $("#placesRemEdit")
            var description = $("#descriptionEdit");
            var allFields = $([]).add(name).add(start).add(startheures).add(startminutes).add(endjours).add(endheures).add(endminutes).add(places).add(description).add(placesRestantes);
            var tips = $(".validateTips");
            var id = $("#eventId");

            function editEvent() {
                var valid = true;
                allFields.removeClass("ui-state-error");

                valid = valid && name.val().length > 0;
                // valid = valid && (parseInt(startheures.val()) > 0 || parseInt(startminutes.val()) > 0);
                valid = valid && isNumeric(startheures.val()) && isNumeric(startminutes.val()) && isNumeric(endjours.val()) && isNumeric(endheures.val()) && isNumeric(endminutes.val())
                valid = valid && (parseInt(endjours.val()) > 0 || parseInt(endheures.val()) > 0 || parseInt(endminutes.val()) > 0);
                valid = valid && isNumeric(places.val());
                valid = valid && parseInt(places.val()) > 0;
                valid = valid && parseInt(endjours.val()) >= 0 && parseInt(endheures.val()) >= 0 && parseInt(endminutes.val()) >= 0;

                if(valid) {
                    var finalId = parseInt(id.val());
                    var finalName = name.val();

                    var tmpStart = start.val().split('/');
                    tmpStart = tmpStart.map(x => parseInt(x));
                    var finalStart = `${tmpStart[2]}-${tmpStart[1]}-${tmpStart[0]} ${startheures.val()}:${startminutes.val()}:00`;

                    var startDate = new Date(tmpStart[2], tmpStart[1] - 1, tmpStart[0], parseInt(startheures.val()), parseInt(startminutes.val()));

                    var endDate = new Date(startDate.getTime() + parseInt(endjours.val()) * 24 * 60 * 60 * 1000);
                    endDate = new Date(endDate.getTime() + parseInt(endheures.val()) * 60 * 60 * 1000);
                    endDate = new Date(endDate.getTime() + parseInt(endminutes.val()) * 60 * 1000);

                    console.log(endDate.getMonth());
                    var finalEnd = `${endDate.getFullYear()}-${endDate.getMonth() + 1 < 10 ? "0" + (endDate.getMonth() + 1) : endDate.getMonth() + 1}-${endDate.getDate() < 10 ? "0" + endDate.getDate() : endDate.getDate()} `;
                    finalEnd = finalEnd + `${endDate.getHours() < 10 ? "0" + endDate.getHours() : endDate.getHours()}:${endDate.getMinutes() < 10 ? "0" + endDate.getMinutes() : endDate.getMinutes()}:00`;

                    var finalPlaces = parseInt(places.val());

                    var finalPlacesRestantes = parseInt(placesRestantes.val());

                    var finalDescription = description.val();

                    var SITEURL = "{{url('/')}}/";

                    $.ajax({
                        url: SITEURL + "fullcalendar/update",
                        data: {title: finalName, start: finalStart, end: finalEnd, places: finalPlaces, id: finalId, description: finalDescription},
                        type: "POST",
                        success: function (data) {
                            displayMessage("Edited Successfully");
                            $('#calendar').fullCalendar('removeEvents', event.id);
                            var calendar = $('#callendar').fullCalendar();
                            calendar.fullCalendar('renderEvent',
                            {
                                title: finalName,
                                start: finalStart,
                                end: finalEnd,
                            },
                            true);

                            var dialog = $("#dialog-form-click").dialog();
                            dialog.dialog("close");
                        }
                    });

                    // $.ajax({
                    //     url: SITEURL + "fullcalendar/" + 1,
                    //     type: 'GET',
                    //     dataType: 'JSON',
                    //     success: function(data) {
                    //         // console.log(data[0]);
                    //     }
                    // });

                    calendar = $("#calendar").fullCalendar();

                    calendar.fullCalendar('renderEvent',
                    {
                        title: finalName,
                        start: finalStart,
                        end: finalEnd,
                    },
                    true);

                    var dialog = $("#dialog-form").dialog();
                    dialog.dialog("close");

                    $('#calendar').fullCalendar('refetchEvents');
                    $('#calendar').fullCalendar('rerenderEvents');
                }

            }

            function removeEvent() {
                var finalId = id.val();
                var SITEURL = "{{url('/')}}/";

                var deleteEvt = confirm("Êtes-vous sûr de vouloir supprimer cet événement ?");
                if(deleteEvt) {
                    $.ajax({
                        type: "POST",
                        url: SITEURL + 'fullcalendar/delete',
                        data: {id: finalId},
                        success: function (response) {
                            if(parseInt(response) > 0) {
                                $('#calendar').fullCalendar('removeEvents', finalId);
                                displayMessage("Deleted Successfully");
                            }

                            var dialog = $("#dialog-form-click").dialog();
                            dialog.dialog("close");

                            $('#calendar').fullCalendar('refetchEvents');
                            $('#calendar').fullCalendar('rerenderEvents');
                        }
                    });
                }
            }

            var userRole = parseInt($("#authRole").val());
            console.log(userRole);

            if(userRole == 0) {
                dialog = $( "#dialog-form-click" ).dialog({
                    autoOpen: false,
                    height: 660,
                    width: 350,
                    modal: true,
                    resizable: false,
                    buttons: {
                        "S'inscrire": signupEvent,
                        "Fermer": function() {
                            dialog.dialog("close");
                        },
                    },
                    close: function() {
                        form[ 0 ].reset();
                        allFields.removeClass( "ui-state-error" );
                    }
                });
            }

            else if(userRole == 1) {
                dialog = $( "#dialog-form-click" ).dialog({
                    autoOpen: false,
                    height: 680,
                    width: 350,
                    modal: true,
                    resizable: false,
                    buttons: {
                        "Modifier": editEvent,
                        "Supprimer": removeEvent,
                        "Annuler": function() {
                            dialog.dialog("close");
                        },
                    },
                    close: function() {
                        form[ 0 ].reset();
                        allFields.removeClass( "ui-state-error" );
                    }
                });
            }

            form = dialog.find( "form" ).on( "submit", function( event ) {
                event.preventDefault();
                editUser();
            });
        });
    </script>
@endsection

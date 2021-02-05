@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Edition d'un utilisateur</h2>
                        </div>
                    </div>
                </div>


                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Attention !</strong> Un ou plusieurs problèmes ont été trouvé.<br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                <div class="row">
                    <!--Nom-->
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <strong>Nom :</strong>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">#</span>
                            </div>
                            {!! Form::text('lastname', null, array('placeholder' => 'Nom','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <!--Prénom-->
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <strong>Prénom :</strong>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">#</span>
                            </div>
                            {!! Form::text('name', null, array('placeholder' => 'Prénom','class' => 'form-control')) !!}
                        </div>
                    </div>
                    <!--Email-->
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <strong>Email :</strong>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">@</span>
                            </div>
                        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                        <!--<div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">@univ-lorraine.fr</span>
                            </div>-->
                        </div>
                    </div>
                    <!--Password-->
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <strong>Mot de passe :</strong>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                {!! Form::password('password', array('placeholder' => 'Mot de passe', 'class' => 'form-control')) !!}
                                <div class="feedback">Laissez vide pour ne pas modifier</div>

                            </div>

                            <div class="form-group col-md-6">
                                {!! Form::password('confirm-password', array('placeholder' => 'Confirmation du mot de passe', 'class' => 'form-control')) !!}
                            </div>
                        </div>
                    </div>
                    <!--Role-->
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Role:</strong>
                            {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','multiple')) !!}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <a class="btn btn-danger" href="{{ route('users.index') }}">Annuler</a>
                        <button type="submit" class="btn btn-primary" id="submitBtn">Modifier</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Créer un rôle</h2>
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


                {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nom du groupe :</strong>
                            {!! Form::text('Nom', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <strong>Permission:</strong>
                <br/>
                @foreach($permission as $value)
                    <label class="col-xs-3 col-sm-3 col-md-3">
                        {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                        {{ $value->description }}
                        <br/>
                        ({{ $value->name }})
                    </label>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
        <a class="btn btn-danger" href="{{ route('roles.index') }}">Annuler</a>
        <button type="submit" class="btn btn-primary">Créer</button>
    </div>
    {!! Form::close() !!}



@endsection

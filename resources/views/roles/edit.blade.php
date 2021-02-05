@extends('layouts.app')


@section('content')
    <div class="" style="margin-left: 15%; margin-right: 15%">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Modification du groupe</h2>
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


                {!! Form::model($role, ['method' => 'PATCH','route' => ['roles.update', $role->id]]) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Nom du groupe :</strong>
                            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <strong>Permission:</strong>
                        <br/>
                        @foreach($permission as $value)
                            <label class="col-xs-3 col-sm-3 col-md-3">
                                {{ Form::checkbox('permission[]', $value->id, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'name')) }}
                                {{ $value->description }}
                                <br/>
                                ({{ $value->name }})
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <a class="btn btn-danger" href="{{ route('roles.index') }}">Annuler</a>
                    <button type="submit" class="btn btn-primary">Sauvegarder</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>


@endsection

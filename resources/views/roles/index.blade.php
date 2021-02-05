@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <div class="row">
                    <div class="col-lg-12 margin-tb">
                        <div class="pull-left">
                            <h2>Liste des groupes</h2>
                        </div>
                        <div class="pull-right">
                            @can('role.create')
                                <a class="btn btn-success" href="{{ route('roles.create') }}">Nouveau rôle</a>
                            @endcan
                        </div>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"width="20px">N°</th>
                            <th scope="col">Groupes</th>
                            <th width="280px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $role->name }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('roles.show',$role->id) }}">Voir</a>
                                @can('role.edit')
                                    <a class="btn btn-primary" href="{{ route('roles.edit',$role->id) }}">Editer</a>
                                @endcan
                                @can('role.delete')
                                    {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Supprimer', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                {!! $roles->render() !!}
            </div>
        </div>
    </div>
@endsection

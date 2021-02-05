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
                            <h2>@lang('fle.manage.user.title')</h2>
                        </div>
                        <div class="pull-right">
                            <a class="btn btn-success" href="{{ route('users.create') }}">@lang('fle.manage.user.new_user')</a>
                        </div>
                    </div>
                </div>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">@lang('fle.manage.user.num')</th>
                        <th scope="col">@lang('fle.manage.user.lastname')</th>
                        <th scope="col">@lang('fle.manage.user.name')</th>
                        <th scope="col">@lang('fle.manage.user.email')</th>
                        <th scope="col">@lang('fle.manage.user.roles')</th>
                        <th width="280px">@lang('fle.manage.user.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $key => $user)
                        <tr>
                            <th scope="row">{{ ++$i }}</th>
                            <td>{{ $user->lastname }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                        @if(strcasecmp($v,"Admin") == 0)
                                            <label class="badge badge-danger">{{ $v }}</label>
                                        @else
                                            <label class="badge badge-success">{{ $v }}</label>
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">@lang('fle.manage.user.show.title')</a>
                                <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">@lang('fle.manage.user.edit.title')</a>
                                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                {!! Form::submit(__('fle.manage.user.delete'), ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!! $data->render() !!}
            </div>
        </div>
    </div>
@endsection



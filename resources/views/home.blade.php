@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @guest
                        Connectez vous pour accéder aux ressources internes
                    @else
                        Vous êtes connecté !
                        <br>
                        <br>
                        <a href="/profile" class="btn btn-secondary">Accéder à votre profil</a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

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

                    Bonjour à vous, <span style="font-weight: 600">{{ $user->name  }}</span> !
                    <br>
                        Félicitations pour votre rôle : <span style="font-weight: 600">{{ucfirst($user->roles()->pluck('name')[0])}}</span>.
                    <hr />
                    <a href="{{ route('profile_show', $user->id) }}"><button type="submit" class="btn btn-success">Upload une video</button></a>
                    <a href="{{ route('profile_show', $user->id) }}"><button type="submit" class="btn btn-secondary">Mon profil</button></a>
                    <a href="{{ route('password.request') }}"><button type="submit" class="btn btn-dark">Changer de mot de passe</button></a>
                    <a href="{{ route('profile_destroy', $user->id) }}"><button type="submit" class="btn btn-danger">Supprimer le compte</button></a>
                </div>
            </div>
            <div class="card-group text-center mt-2">
                <div class="card text-white bg-dark mb-3" >
                    <div class="card-header">Nombre de vidéos</div>
                    <div class="card-body">
                        <h2 class="card-title">8</h2>
                    </div>
                </div>
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-header">Nombre d'abonnés</div>
                    <div class="card-body">
                        <h2 class="card-title">27</h2>
                    </div>
                </div>
                <div class="card text-white bg-dark mb-3">
                    <div class="card-header">Nombre de commentaires</div>
                    <div class="card-body">
                        <h2 class="card-title">389</h2>
                    </div>
                </div>
            </div>
            <div class="card-group text-center">
                <div class="card text-white bg-success mb-3">
                    <div class="card-header">Nombre de likes</div>
                    <div class="card-body">
                        <h2 class="card-title">973</h2>
                    </div>
                </div>
                <div class="card text-white bg-danger mb-3">
                    <div class="card-header">Nombre de dislikes</div>
                    <div class="card-body">
                        <h2 class="card-title">85</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

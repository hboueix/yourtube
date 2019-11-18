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

                    Bonjour à vous, {{ $user->name  }} !
                    <br>
                    Félicitations pour votre rôle qui est {{ucfirst($user->roles()->pluck('name')[0])}}.
                    <hr />
                    <a href="{{ route('profile_show') }}"><button type="submit" class="btn btn-success">Upload une video</button></a>
                    <a href="{{ route('profile_show') }}"><button type="submit" class="btn btn-secondary">Mon profil</button></a>
                    <a href="{{ route('password.request') }}"><button type="submit" class="btn btn-dark">Changer de mot de passe</button></a>
                    <a href="{{ route('profile_destroy') }}"><button type="submit" class="btn btn-danger">Supprimer le compte</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

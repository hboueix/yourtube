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
                    <hr />
                    <a href="{{ route('show') }}"><button type="submit" class="btn btn-success">Mon profil</button></a>
                    <a href=""><button type="submit" class="btn btn-warning">Changer de mot de passe</button></a>
                    <a href="{{ route('delete') }}"><button type="submit" class="btn btn-danger">Supprimer le compte</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

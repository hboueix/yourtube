@extends('layouts.app')
@section('content')
    @if (session('profile_updated'))
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Profil mis à jour avec succès !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    @if (session('profile_avatar_error'))
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                L'avatar doit être une image en png ou jpg !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('Editer son profil') }}</div>
                    <form method="post" action="{{ route('profile_update') }}" enctype="multipart/form-data" class="pl-4 pr-4 pt-2 pb-2">
                        <label>Avatar</label>
                        <div class="custom-file">
                            <label class="custom-file-label" for="customFile">Changer d'avatar</label>
                            <input type="file" class="custom-file-input" id="customFile" name="image">
                        </div>
                        <div class="form-group mt-2">
                            <label for="first_name">Prénom</label>
                            <input type="text" class="form-control" id="first_name" placeholder="Prénom"
                                   name="first_name" value="{{ $profile ?? '' ? $profile->first_name : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Nom</label>
                            <input type="text" class="form-control" id="last_name" placeholder="Nom" name="last_name"
                                   value="{{ $profile ?? '' ? $profile->last_name : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Date de naissance</label>
                            <input type="date" id="age" placeholder="Definissez une date de naissance"
                                   class="form-control" name="birthday"
                                   value="{{ $profile ?? '' ? substr($profile->dateOfBirth, 0, 10) : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Adresse Email</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                   placeholder="Entrez votre email" name="email"
                                   value="{{ Auth::user() ?? '' ? Auth::user()->email : '' }}" required>
                        </div>
                        <input type="hidden" name="id" value="">
                        @csrf
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

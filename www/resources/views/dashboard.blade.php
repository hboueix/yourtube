@extends('layouts.app')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="delete" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Supprimer son compte</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h6>Êtes-vous sûr de vouloir supprimer votre compte ?</h6>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('profile_destroy') }}">
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash"
                                                                        style="margin-right: 10px"></i>Supprimer !
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        Bonjour à vous, <span style="font-weight: 600">{{ $user->name  }}</span> !
                        <br>
                        Félicitations pour votre rôle : <span
                            style="font-weight: 600">{{ucfirst($user->roles()->pluck('name')[0])}}</span>.
                        <hr/>
                        <a href="{{ route('profile_show', Auth::user()->name) }}">
                            <button type="submit" class="btn btn-secondary">
                                <i class="fas fa-user" style="margin-right: 5px"></i>Mon profil
                            </button>
                        </a>
                        <a href="{{ route('password.request') }}">
                            <button type="submit" class="btn btn-dark">
                                <i class="fas fa-key" style="margin-right: 5px"></i>Changer de mot de passe
                            </button>
                        </a>
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete">
                            <i class="fas fa-trash" style="margin-right: 5px"></i>Supprimer le compte
                        </button>
                    </div>
                </div>
                <div class="card text-white text-center bg-info mb-3">
                    <div class="card-header">Nombre d'abonnés</div>
                    <div class="card-body">
                        <h2 class="card-title">{{ $nb_subscribers }}</h2>
                    </div>
                </div>
                <div class="card-group text-center mt-2">
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header"><i class="fas fa-video"></i></div>
                        <div class="card-body">
                            <h2 class="card-title">{{ $nb_videos }}</h2>
                        </div>
                    </div>
                    <div class="card text-white bg-dark mb-3">
                        <div class="card-header"><i class="fas fa-comments"></i></div>
                        <div class="card-body">
                            <h2 class="card-title">{{ $nb_comments }}</h2>
                        </div>
                    </div>
                </div>
                <div class="card-group text-center">
                    <div class="card text-white bg-success mb-3">
                        <div class="card-header"><i class="fas fa-thumbs-up"></i></div>
                        <div class="card-body">
                            <h2 class="card-title">{{ $nb_likes }}</h2>
                        </div>
                    </div>
                    <div class="card text-white bg-danger mb-3">
                        <div class="card-header"><i class="fas fa-thumbs-down"></i></div>
                        <div class="card-body">
                            <h2 class="card-title">{{$nb_dislikes}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

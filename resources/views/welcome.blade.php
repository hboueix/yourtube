@extends('layouts.app')

@section('content')
    @if (session('account_deleted'))
        <div class="alert alert-success">
            Compte supprimé avec succès !
        </div>
    @endif
    <div class="container">
        <div class="card">
            <div class="card-header">
                Dernières vidéos
            </div>
            @foreach($videos as $video)
            <div class="card-body">
                <div class="card" style="width: 25%;">
                    <video width="320" height="240" class="card-img-top" controls>
                        <source src="https://www.videvo.net/videvo_files/converted/2013_07/videos/hd0079.mov26726.mp4" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    <div class="card-body">
                        <h5 class="card-title">{{ $video->title }}</h5>
                        <p class="card-text">{{ $video->description }}</p>
                        <a href="#" class="btn btn-primary">Voir la vidéo</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection

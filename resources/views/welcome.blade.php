@extends('layouts.app')

@section('content')
    @if (session('account_deleted'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Compte supprimé avec succès !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('video_edit_error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Vous n'êtes pas le propriétaire de cette vidéo !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container">
        <div class="card row" style="width: 110%">
            <div class="card-header">
                Fil d'actualité
            </div>
            <div class="card-body">
                <h4>Récemments publiées</h4>
                <hr/>
                <div class="container" style="margin-bottom: 20px">
                    <div class="row">
                        @foreach($videos as $video)
                            <div class="card col-sm-4">
                                <div
                                    style="width: 100%; height: 200px; background-image: url('{{asset('storage/'. $video->miniature)}}'); background-position: center; background-size: cover">
                                </div>
                                <a href="{{ route('video_show', $video->id) }}" style="text-decoration: none; color: inherit">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $video->title }}</h5>
                                        <h6>{{$video->nbWatch}} vues</h6>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <h4>Vidéos tendances</h4>
                <hr/>
                <div class="container" style="margin-bottom: 20px">
                    <div class="row">
                        @foreach($tend_videos as $t_video)
                            <div class="card col-sm-4">
                                <div
                                    style="width: 100%; height: 200px; background-image: url('{{asset('storage/'. $video->miniature)}}'); background-position: center; background-size: cover">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $t_video->title }}</h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <h4>Toutes les vidéos</h4>
                <hr/>
                <div class="container" style="margin-bottom: 20px">
                    <div class="row">
                        @foreach ($rand_videos as $r_video)
                            <div class="card col-sm-4">
                                <div
                                    style="width: 100%; height: 200px; background-image: url('{{asset('storage/'. $video->miniature)}}'); background-position: center; background-size: cover">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title">{{ $r_video->title }}</h5>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

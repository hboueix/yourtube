@extends('layouts.app')

@section('content')
    @if (session('account_deleted'))
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Compte supprimé avec succès !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    @if (session('video_edit_error'))
        <div class="container">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Vous n'êtes pas le propriétaire de cette vidéo !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    @if (session('video_waiting'))
        <div class="container">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Cette vidéo n'a pas encoré été validée par notre équipe.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    <div class="container">
        <div class="card-body">
            <h4>Récemments publiées</h4>
            <hr/>
            <div class="row">
                @foreach($videos as $video)
                    <div class="col-sm-4">
                        <a href="{{ route('video_show', $video->id) }}"
                           style="text-decoration: none; color: inherit">
                            <div
                                style="width: 100%; height: 200px; background-image: url('{{asset('storage/'. $video->miniature)}}'); background-position: center; background-size: cover">
                            </div>
                            <div class="card-body">
                                <h5
                                    class="card-title">{{ $video->title }}</h5>
                        </a>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="badge badge-pill badge-info">{{$video->category_name}}</span>
                            <span><i class="fas fa-eye mr-1"></i>{{$video->nbWatch}}</span>
                        </div>
                    </div>
            </div>
            @endforeach
        </div>
        <h4>Vidéos tendances</h4>
        <hr/>
        <div class="row">
            @foreach($tend_videos as $t_video)
                <div class="col-sm-4">
                    <a href="{{ route('video_show', $t_video->id) }}"
                       style="text-decoration: none; color: inherit">
                        <div
                            style="width: 100%; height: 200px; background-image: url('{{asset('storage/'. $t_video->miniature)}}'); background-position: center; background-size: cover">
                        </div>
                        <div class="card-body">
                            <h5
                                class="card-title">{{ $t_video->title }}</h5>
                    </a>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge badge-pill badge-info">{{$video->category_name}}</span>
                        <span><i class="fas fa-eye mr-1"></i>{{$t_video->nbWatch}}</span>
                    </div>
                </div>
        </div>
        @endforeach
    </div>
    <h4>Toutes les vidéos</h4>
    <hr/>
    <div class="row">
        @foreach ($rand_videos as $r_video)
            <div class="col-sm-4">
                <a href="{{ route('video_show', $r_video->id) }}"
                   style="text-decoration: none; color: inherit">
                    <div
                        style="width: 100%; height: 200px; background-image: url('{{asset('storage/'. $r_video->miniature)}}'); background-position: center; background-size: cover">
                    </div>
                    <div class="card-body">
                        <h5
                            class="card-title">{{ $r_video->title }}</h5>
                </a></div>
                <div class="d-flex justify-content-between align-items-center">
                    <span class="badge badge-pill badge-info">{{$video->category_name}}</span>
                    <span><i class="fas fa-eye mr-1"></i>{{$r_video->nbWatch}}</span>
                </div>
            </div>
        @endforeach
    </div>
@endsection

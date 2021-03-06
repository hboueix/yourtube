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
            <h4 class="mt-5">Récemments publiées</h4>
            <hr/>
            <div class="row">
                @foreach($videos as $video)
                    <div class="col-sm-4 pb-3">
                        <a href="{{ route('video_show', $video->id) }}"
                           style="text-decoration: none; color: inherit">
                            <div
                                style="width: 100%; height: 200px; background-image: url('{{asset('storage/'. $video->miniature)}}'); background-position: center; background-size: cover">
                            </div>
                                <h5
                                    class="card-title pt-2">{{ $video->title }}</h5>
                        </a>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('category_show', $video->category_id) }}" title="Catégorie : {{$video->category_name}}"><span
                                    class="badge badge-pill badge-info"
                                    style="color: white">{{$video->category_name}}</span></a>
                            <span title="Nombre de vues"><i class="fas fa-eye mr-1"></i>{{$video->nbWatch}}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <h4 class="mt-5">Vidéos tendances</h4>
            <hr/>
            <div class="row">
                @foreach($tend_videos as $t_video)
                    <div class="col-sm-4 pb-3">
                        <a href="{{ route('video_show', $t_video->id) }}"
                           style="text-decoration: none; color: inherit">
                            <div
                                style="width: 100%; height: 200px; background-image: url('{{asset('storage/'. $t_video->miniature)}}'); background-position: center; background-size: cover">
                            </div>
                                <h5
                                    class="card-title pt-2">{{ $t_video->title }}</h5>
                        </a>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('category_show', $t_video->category_id) }}" title="Catégorie : {{$t_video->category_name}}"><span
                                    class="badge badge-pill badge-info"
                                    style="color: white">{{$t_video->category_name}}</span></a>
                            <span title="Nombre de vues"><i class="fas fa-eye mr-1"></i>{{$t_video->nbWatch}}</span>
                        </div>
                    </div>
                @endforeach
            </div>
            <h4 class="mt-5">Toutes les vidéos</h4>
            <hr/>
            <div class="row">
                @foreach ($rand_videos as $r_video)
                    <div class="col-sm-4 pb-3">
                        <a href="{{ route('video_show', $r_video->id) }}"
                           style="text-decoration: none; color: inherit">
                            <div
                                style="width: 100%; height: 200px; background-image: url('{{asset('storage/'. $r_video->miniature)}}'); background-position: center; background-size: cover">
                            </div>
                                <h5
                                    class="card-title pt-2">{{ $r_video->title }}</h5>
                        </a>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('category_show', $r_video->category_id) }}" title="Catégorie : {{$r_video->category_name}}"><span
                                    class="badge badge-pill badge-info"
                                    style="color: white">{{$r_video->category_name}}</span></a>
                            <span title="Nombre de vues"><i class="fas fa-eye mr-1"></i>{{$r_video->nbWatch}}</span>
                        </div>
                    </div>
                @endforeach
            </div>
@endsection

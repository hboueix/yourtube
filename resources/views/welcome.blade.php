@extends('layouts.app')

@section('content')
    @if (session('account_deleted'))
        <div class="alert alert-success">
            Compte supprimé avec succès !
        </div>
    @endif
    <div class="container">
        <div class="card row" style="width: 110%">
            <div class="card-header">
                Fil d'actualité
            </div>
            <div class="card-body">
            <h4>Récemments publiées</h4>
            <hr />
            <div class="container" style="margin-bottom: 20px">
            <div class="row">
            @foreach($videos as $video)
            <div class="card col-sm-4">
                <img src="{{asset('storage/'. $video->image)}}">
                <div class="card-body">
                    <h5 class="card-title">{{ $video->title }}</h5>
                </div>
            </div>
            @endforeach
            </div>
            </div>
            <h4>Vidéos tendances</h4>
            <hr />
            <div class="container" style="margin-bottom: 20px">
            <div class="row">
            @foreach($tend_videos as $t_video)
            <div class="card col-sm-4">
                <img src="{{asset('storage/'. $video->image)}}">
                <div class="card-body">
                    <h5 class="card-title">{{ $t_video->title }}</h5>
                </div>
            </div>
            @endforeach
            </div>
            </div>
            <h4>Toutes les vidéos</h4>
            <hr />
            <div class="container" style="margin-bottom: 20px">
            <div class="row">
            @foreach ($rand_videos as $r_video)
            <div class="card col-sm-4">
                <img src="{{asset('storage/'. $video->image)}}">
                <div class="card-body">
                    <h5 class="card-title">{{ $r_video->title }}</h5>
                </div>
            </div>
            @endforeach
            </div>
            </div>
        </div>
    </div>
@endsection

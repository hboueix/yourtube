@extends('layouts.app')

@section('content')
    <div class="container">
        <video width="100%" controls>
            <source src="{{asset('storage/'. $videos->path) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div style="margin-top: 20px">
            <div class="d-flex justify-content-between">
                <div>
                    <h2>{{$videos->title}}</h2>
                    <button type="button" class="btn btn-success"><i class="fas fa-thumbs-up"
                                                                     style="margin-right: 10px"></i>J'aime
                    </button>
                    <button type="button" class="btn btn-danger"><i class="fas fa-thumbs-down"
                                                                    style="margin-right: 10px"></i>J'aime pas
                    </button>
                </div>
                <div><h3>{{$videos->nbWatch}} vues</h3></div>
            </div>
        </div>
        <hr>
        <img src="{{ asset('storage/' . $videos->avatar)}}" style="width: 80px; height: 80px; border-radius: 100%">
        <h4>{{$videos->name}}</h4>
        Partager sur :
        <a href="https://www.facebook.com/sharer/sharer.php?u={{route('video_show', $videos->id)}}" target="_blank">
            Facebook
        </a>
        <a href="https://twitter.com/intent/tweet?text=Cette vidéo pourrait vous intéresser : {{route('video_show', $videos->id)}}"
           target="_blank">
            Twitter
        </a>
        <a href="https://www.linkedin.com/shareArticle?url={{route('video_show', $videos->id)}}" target="_blank">
            LinkedIn
        </a>
        <a href="mailto:?subject={{$videos->title}}'&body=Cette vidéo pourrait vous intéresser : {{route('video_show', $videos->id)}} via Yourtube.fr"
           target="_blank">
            Mail
        </a>
    </div>
@endsection

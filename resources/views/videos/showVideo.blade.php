@extends('layouts.app')

@section('content')
    @if (session('video_reported'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Vidéo signalée avec succès !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('comment_created'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Commentaire publié avec succès !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('video_disliked_error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Vous ne pouvez pas disliker une vidéo que vous avez déjà disliké !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('video_disliked'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Vidéo disliked avec succès !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('video_liked_error'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            Vous ne pouvez pas liker une vidéo que vous avez déjà liké !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('video_liked'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Vidéo liked avec succès !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <!-- Modal -->
    <div class="modal fade" id="reporting" tabindex="-1" role="dialog" aria-labelledby="reporting" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Signaler cette vidéo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('video_report', $video->id)}}">
                    <div class="modal-body">
                        <h6>{{ $video->title }}</h6>
                        <label for="content"></label><textarea type="text" class="form-control" id="content"
                                                               placeholder="Votre signalement..."
                                                               name="content"></textarea>
                    </div>
                    <input type="hidden" name="id" value="">
                    @csrf
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger"><i class="fas fa-flag"
                                                                        style="margin-right: 10px"></i>Signaler !
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
        <video width="100%" controls>
            <source src="{{asset('storage/'. $video->path) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <div style="margin-top: 20px;">
            <div class="d-flex justify-content-between">
                <div style="width: 86%">
                    <h2>{{$video->title}}</h2>
                        <a href="{{route('video_like', $video->id)}}">
                            <button type="button" class="btn btn-success"><i class="fas fa-thumbs-up"
                                                                             style="margin-right: 10px"></i>
                                <span class="badge badge-light">{{$nb_likes ?? 0}}</span>
                            </button>
                        </a>
                        <a href="{{route('video_dislike', $video->id)}}">
                            <button type="button" class="btn btn-danger"><i class="fas fa-thumbs-down"
                                                                            style="margin-right: 10px"></i>
                                <span class="badge badge-light">{{$nb_dislikes ?? 0}}</span>
                            </button>
                        </a>
                </div>
                <div  class="text-right">
                    <h3>{{$video->nbWatch}} vues</h3>
                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#reporting"><i
                                class="fas fa-flag"
                                style="margin-right: 10px"></i>Signaler
                    </button>
                </div>
                <div></div>
            </div>
        </div>
        <hr>
        <img src="{{ asset('storage/' . $yourtubeur->avatar)}}" style="width: 80px; height: 80px; border-radius: 100%">
        <h4>{{$yourtubeur->first_name . ' ' . $yourtubeur->last_name}}</h4>
        Partager sur :
        <a href="https://www.facebook.com/sharer/sharer.php?u={{route('video_show', $video->id)}}" target="_blank">
            <button type="button" class="btn btn-primary btn-sm"><i class="fab fa-facebook"
                                                                    style="margin-right: 5px;"></i>Facebook
            </button>
        </a>
        <a href="https://twitter.com/intent/tweet?text=Cette vidéo pourrait vous intéresser : {{route('video_show', $video->id)}}"
           target="_blank">
            <button type="button" class="btn btn-primary btn-sm"><i class="fab fa-twitter"
                                                                    style="margin-right: 5px;"></i>Twitter
            </button>
        </a>
        <a href="https://www.linkedin.com/shareArticle?url={{route('video_show', $video->id)}}" target="_blank">
            <button type="button" class="btn btn-primary btn-sm"><i class="fab fa-linkedin"
                                                                    style="margin-right: 5px;"></i>Linkedin
            </button>
        </a>
        <a href="mailto:?subject={{$video->title}}'&body=Cette vidéo pourrait vous intéresser : {{route('video_show', $video->id)}} via Yourtube.fr"
           target="_blank">
            <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-envelope"
                                                                    style="margin-right: 5px;"></i>Mail
            </button>
        </a>
        <hr/>
        <h4>Commentaires</h4>
        @auth
            <form method="post" action="{{ route('comments_post', $video->id) }}">
                <div class="input-group mb-1">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Rejoindre la conversation</span>
                    </div>
                    <textarea class="form-control" aria-label="With textarea" name="comment" required></textarea>
                    @csrf
                    <button type="submit" class="btn btn-success">Publier</button>
                </div>
            </form>
        @endauth
        @guest
            <div class="alert alert-warning" role="alert">
                Veuillez vous inscrire pour pouvoir commenter cette vidéo.
            </div>
        @endguest
        <ul class="list-unstyled">
            @if(isset($comments))
                @foreach($comments as $comment)
                    <li class="media">
                        <img class="mr-3" src="{{asset('storage/'. $yourtubeur->avatar)}}"
                             alt="Generic placeholder image" style="width: 100px; height: 100px">
                        <div class="media-body">
                            <h5 class="mt-0 mb-1">{{$yourtubeur->first_name . ' ' . $yourtubeur->last_name}}</h5>
                            {{$comment->content}}
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
@endsection

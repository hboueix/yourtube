@extends('layouts.app')

@section('content')
    @if (session('video_reported'))
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Vidéo signalée avec succès !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    @if (session('comment_created'))
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Commentaire publié avec succès !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    @if (session('video_disliked_error'))
        <div class="container">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Vous ne pouvez pas disliker une vidéo que vous avez déjà disliké !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    @if (session('video_disliked'))
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Vidéo disliked avec succès !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    @if (session('video_liked_error'))
        <div class="container">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Vous ne pouvez pas liker une vidéo que vous avez déjà liké !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    @if (session('video_liked'))
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Vidéo liked avec succès !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    @if (session('user_subscribed'))
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Vous vous êtes abonné avec succès !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    @if (session('user_unsubscribed'))
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Vous vous êtes désabonné avec succès !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    @if (session('user_subscribed_error'))
        <div class="container">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Vous êtes déjà abonné à ce profil !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
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
    <div class="modal fade" id="delete_video" tabindex="-1" role="dialog" aria-labelledby="delete_video"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Supprimer cette vidéo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('video_destroy', $video->id)}}">
                    <div class="modal-body">
                        <p>Voulez -vous vraiment supprimer cette vidéo ?</p>
                    </div>
                    @csrf
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger"><i class="fas fa-flag"
                                                                        style="margin-right: 10px"></i>Supprimer
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
        <div class="mt-3">
            <div class="d-flex justify-content-between">
                <h2>{{$video->title}}</h2>
                <h3>{{($video->nbWatch <= 1 ? $video->nbWatch . ' vue' : $video->nbWatch . ' vues')}}</h3>
            </div>
            <div class="d-flex justify-content-between">
                <div>
                    <a href="{{route('video_like', $video->id)}}">
                        <button type="button" class="btn btn-success"><i class="fas fa-thumbs-up"
                                                                         style="margin-right: 10px"></i>
                            <span>{{$nb_likes ?? 0}}</span>
                        </button>
                    </a>
                    <a href="{{route('video_dislike', $video->id)}}">
                        <button type="button" class="btn btn-danger"><i class="fas fa-thumbs-down"
                                                                        style="margin-right: 10px"></i>
                            <span>{{$nb_dislikes ?? 0}}</span>
                        </button>
                    </a>
                </div>
                @if(Auth::user())
                    @if(Auth::user()->hasAnyRole(['administrateur', 'moderateur']))
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_video">
                            <i class="fas fa-times" style="margin-right: 10px"></i>Supprimer
                        </button>
                    @else
                        <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                data-target="#reporting"><i
                                class="fas fa-flag"
                                style="margin-right: 10px"></i>Signaler
                        </button>
                    @endif
                @endif
            </div>
        </div>
        <hr>
        <div class="d-flex justify-content-between">
            <a href="{{route('profile_show', $yourtubeur->name)}}" style="color: inherit">
                <div class="d-flex align-items-center">
                    @if(strlen($yourtubeur->avatar) > 0)
                        <img src="{{ asset('storage/' . $yourtubeur->avatar) }}" class="mr-3" alt="miniature"
                             style="width: 80px; height: 80px; border-radius: 100%">
                    @else
                        <img src="https://static.asianetnews.com/img/default-user-avatar.png"
                             style="width: 80px; height: 80px; border-radius: 100%">
                    @endif
                    <h4 class="ml-2">{{$yourtubeur->first_name . ' ' . $yourtubeur->last_name}}</h4>
                </div>
            </a>
            <div>
                @if($yourtubeur->user_id == \Illuminate\Support\Facades\Auth::id())
                    <span class="btn btn-primary ml-2">{{$nb_subscribers ?? 0 }}
                        @if($nb_subscribers <= 1)
                            abonné
                        @else
                            abonnés
                        @endif
                    </span>
                @else
                    @if($subscriber != null)
                        @if($subscriber->is_subscribed === 1)
                            <a href="{{route('profile_unsubscribe', [$yourtubeur->id, $video->id])}}">
                                <button type="button" class="btn btn-danger">Se désabonner<span
                                        class="ml-2">{{$nb_subscribers ?? 0 }}</span></button>
                            </a>
                        @else
                            <a href="{{route('profile_subscribe', [$yourtubeur->id, $video->id])}}">
                                <button type="button" class="btn btn-primary">S'abonner<span
                                        class="ml-2">{{$nb_subscribers ?? 0 }}</span></button>
                            </a>
                        @endif
                    @else
                        <a href="{{route('profile_subscribe', [$yourtubeur->id, $video->id])}}">
                            <button type="button" class="btn btn-primary">S'abonner<span
                                    class="ml-2">{{$nb_subscribers ?? 0 }}</span></button>
                        </a>
                    @endif
                @endif
            </div>
        </div>
        <div class="mt-3">
            <p>{{$video->description}}</p>
        </div>
        <div class="d-flex">
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
            <p>
                <a data-toggle="collapse" href="#iframe" role="button" aria-expanded="false"
                   aria-controls="collapseExample">
                    <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-code" style="margin-right: 5px;"></i>Intégrer
                    </button>
                </a>
            </p>
        </div>
        <div class="collapse" id="iframe">
            <div class="card card-body">
                &lt;iframe width="560" height="315" src="{{asset('storage/'. $video->path)}}"&gt;&lt;/iframe&gt;
            </div>
        </div>
        <hr/>
        @if(count($related_videos) > 0)
            <h2>Vidéos similaires</h2>
            <div class="d-flex justify-content-around flex-nowrap">
                @foreach($related_videos as $related_video)
                    <div class="card w-25 text-center">
                        <a href="{{route('video_show', $related_video->id)}}"
                           style="text-decoration: none; color: inherit;">
                            <img class="card-img-top" src="{{asset('storage/' . $related_video->miniature)}}"
                                 style="width: 100%;"/>
                            <div class="card-body">
                                <h3 class="font-weight-bold">{{$related_video->title}}</h3>
                                <span><i class="fas fa-eye mr-1"></i>{{$related_video->nbWatch}}</span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <hr/>
        @endif
        <div>
            <h4>Commentaires</h4>
            @auth
                <form method="post" action="{{ route('comments_post', $video->id) }}">
                    <div class="input-group mb-1">
                        <input type="text" class="form-control" placeholder="Ecrivez votre commentaire"
                               aria-label="Ecrivez votre commentaire" name="comment">
                        @csrf
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Commenter</button>
                        </div>
                    </div>
                </form>
            @endauth
            @guest
                <div class="alert alert-warning" role="alert">
                    Veuillez vous inscrire pour pouvoir commenter cette vidéo.
                </div>
            @endguest
        </div>
        <ul class="list-unstyled mt-3">
            @if(isset($comments))
                @foreach($comments as $comment)
                    <li class="media mb-2">
                        @if(strlen($comment->avatar) > 0)
                            <img src="{{ asset('storage/' . $comment->avatar) }}" class="mr-3" alt="miniature"
                                 style="width: 80px; height: 80px; border-radius: 100%; margin-right: 20px">
                        @else
                            <img src="https://static.asianetnews.com/img/default-user-avatar.png"
                                 style="width: 80px; height: 80px; border-radius: 100%; margin-right: 20px">
                        @endif
                        <div class="media-body">
                            <h5 class="mt-0 mb-1">{{$comment->first_name . ' ' . $comment->last_name}}</h5>
                            {{$comment->content}}
                        </div>
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
@endsection

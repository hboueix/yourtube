@extends('layouts.app')

@section('content')
    <div aria-live="polite" aria-atomic="true" style="position: -webkit-sticky; position: sticky; top: 20px; left: 20px;">
        <div id='toast-container'>
        </div>
    </div>
    @if (session('video_reported_error'))
        <div class="container">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Vous avez déjà signalé la vidéo.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
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
                                                               placeholder="Raison du signalement..."
                                                               name="content"></textarea>
                    </div>
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
                        <p>Voulez-vous vraiment supprimer cette vidéo ?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"
                                                                        style="margin-right: 5px"></i>Supprimer
                        </button>
                    </div>
                    @csrf
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
                <h2>{{$video->title}}
                    @if($video->is_valid == 0)
                        <span class="badge badge-warning">En attente de modération</span>
                    @endif
                </h2>
                <h3>{{($video->nbWatch <= 1 ? $video->nbWatch . ' vue' : $video->nbWatch . ' vues')}}</h3>
            </div>
            <div class="d-flex justify-content-between">
                <div>
                    @auth
                        <button onclick='videoLike()' type="button" class="btn btn-success"><i class="fas fa-thumbs-up"
                                                                                            style="margin-right: 10px"></i>
                            <span id='nbLike'>{{$nb_likes ?? 0}}</span>
                        </button>
                        <button onclick='videoDislike()' type="button" class="btn btn-danger"><i class="fas fa-thumbs-down"
                                                                                                style="margin-right: 10px"></i>
                            <span id='nbDislike'>{{$nb_dislikes ?? 0}}</span>
                        </button>
                    @endauth
                    @guest
                        <a href="{{route('login')}}">
                            <button type="button" class="btn btn-success"><i class="fas fa-thumbs-up" style="margin-right: 10px"></i>
                                <span id='nbLike'>{{$nb_likes ?? 0}}</span>
                            </button>
                        </a>
                        <a href="{{route('login')}}">
                            <button type="button" class="btn btn-danger"><i class="fas fa-thumbs-down" style="margin-right: 10px"></i>
                                <span id='nbDislike'>{{$nb_dislikes ?? 0}}</span>
                            </button>
                        </a>
                    @endguest
                </div>
                <script type="text/javascript">
                    function videoLike() {
                        const nbLike = document.getElementById('nbLike')
                        const nbDislike = document.getElementById('nbDislike')

                        const xhr = new XMLHttpRequest();

                        xhr.open('GET', '{{route("video_like", $video->id)}}', true);
                        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                        xhr.onreadystatechange = function () {

                            if (xhr.readyState == 4 && xhr.status == 200) {
                                const result = JSON.parse(xhr.response);
                                nbLike.innerHTML = result.nb_likes;
                                nbDislike.innerHTML = result.nb_dislikes;
                            }
                        }
                        xhr.send();
                        // Toaster
                        const toastContainer = document.getElementById('toast-container')
                        toastContainer.innerHTML += "<div id='video_liked' class=\"toast\" role=\"alert\" aria-live=\"assertive\" aria-atomic=\"true\" data-delay='30000'> \
                                                        <div class=\"toast-header\"> \
                                                            <img src=\"{{ asset('storage/favicon.ico') }}\" style='width: 20px;'class=\"rounded mr-2\"> \
                                                            <strong class=\"mr-auto\">Informations</strong> \
                                                            <button type=\"button\" class=\"ml-2 mb-1 close\" data-dismiss=\"toast\" aria-label=\"Close\"> \
                                                                <span aria-hidden=\"true\">&times;</span> \
                                                            </button> \
                                                            </div> \
                                                            <div id='toast-content' class=\"toast-body\"> \
                                                                Vidéo liked avec succès ! \
                                                        </div> \
                                                    </div>"
                        $('#video_liked').toast('show');
                        setTimeout(() => {
                            toastContainer.removeChild(document.getElementById('video_liked'));
                        }, 3000);
                    }

                    function videoDislike() {
                        const nbDislike = document.getElementById('nbDislike')
                        const nbLike = document.getElementById('nbLike')

                        const xhr = new XMLHttpRequest();

                        xhr.open('GET', '{{route("video_dislike", $video->id)}}', true);
                        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                        xhr.onreadystatechange = function () {

                            if (xhr.readyState == 4 && xhr.status == 200) {
                                const result = JSON.parse(xhr.response);
                                nbLike.innerHTML = result.nb_likes;
                                nbDislike.innerHTML = result.nb_dislikes;
                            }
                        }
                        xhr.send();
                        //Toaster
                        const toastContainer = document.getElementById('toast-container')
                        toastContainer.innerHTML += "<div id='video_disliked' class=\"toast\" role=\"alert\" aria-live=\"assertive\" aria-atomic=\"true\" data-delay='30000'> \
                                                        <div class=\"toast-header\"> \
                                                            <img src=\"{{ asset('storage/favicon.ico') }}\" style='width: 20px;'class=\"rounded mr-2\"> \
                                                            <strong class=\"mr-auto\">Informations</strong> \
                                                            <button type=\"button\" class=\"ml-2 mb-1 close\" data-dismiss=\"toast\" aria-label=\"Close\"> \
                                                                <span aria-hidden=\"true\">&times;</span> \
                                                            </button> \
                                                            </div> \
                                                            <div id='toast-content' class=\"toast-body\"> \
                                                                Vidéo disliked avec succès ! \
                                                        </div> \
                                                    </div>"
                        $('#video_disliked').toast('show');
                        setTimeout(() => {
                            toastContainer.removeChild(document.getElementById('video_disliked'));
                        }, 3000);
                    }

                    setTimeout((function() {
                        const xhr = new XMLHttpRequest();
                        xhr.open('GET', '{{route("increment_views", $video->id)}}', true);
                        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                        xhr.send();
                    }), 10000);
                </script>
                @if(Auth::user())
                    @if(Auth::user()->hasAnyRole(['administrateur', 'moderateur']) || Auth::id() == $video->user_id)
                        <button type="button" title="Supprimer la vidéo" class="btn btn-danger" data-toggle="modal"
                                data-target="#delete_video">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    @else
                        <button type="button" class="btn btn-outline-danger" title="Signaler la vidéo"
                                data-toggle="modal"
                                data-target="#reporting"><i
                                class="fas fa-flag"></i>
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
                    <span class="btn btn-secondary ml-2">{{$nb_subscribers ?? 0 }}
                        @if($nb_subscribers <= 1)
                            abonné
                        @else
                            abonnés
                        @endif
                    </span>
                @else
                    @auth
                        @if($subscriber != null)
                            @if($subscriber->is_subscribed === 1)
                                <button id="abonnementBtn" onclick="toggleSubscription()" type="button" class="btn btn-secondary">Se désabonner
                                    <span id="nbSubscribers" class="ml-2">{{$nb_subscribers ?? 0 }}</span>
                                </button>
                            @else
                                <button id="abonnementBtn" onclick="toggleSubscription()" type="button" class="btn btn-secondary">S'abonner
                                    <span id="nbSubscribers" class="ml-2">{{$nb_subscribers ?? 0 }}</span>
                                </button>
                            @endif
                        @else
                            <button id="abonnementBtn" onclick="toggleSubscription()" type="button" class="btn btn-secondary">S'abonner
                                <span id="nbSubscribers" class="ml-2">{{$nb_subscribers ?? 0 }}</span>
                            </button>
                        @endif
                    @endauth
                    @guest
                        <a href="{{route('login')}}">
                            <button id="abonnementBtn" type="button" class="btn btn-secondary">S'abonner
                                <span id="nbSubscribers" class="ml-2">{{$nb_subscribers ?? 0 }}</span>
                            </button>
                        </a>
                    @endguest
                @endif
            </div>
            <script type='text/javascript'>
                function toggleSubscription() {
                    const aboBtn = document.getElementById('abonnementBtn');
                    const nbSubscribers = parseInt(document.getElementById('nbSubscribers').innerHTML);

                    if (aboBtn.innerHTML.match("S'abonner") != null) {
                        const xhr = new XMLHttpRequest();
                        xhr.open('GET', "{{route('profile_subscribe', [$yourtubeur->id, $video->id])}}", true);
                        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                                aboBtn.innerHTML = "Se désabonner<span id='nbSubscribers' class='ml-2'>" + (nbSubscribers + 1) + "</span>";
                            }
                        }
                        xhr.send();
                        //Toaster
                        const toastContainer = document.getElementById('toast-container')
                        toastContainer.innerHTML += "<div id='user_subscribed' class=\"toast\" role=\"alert\" aria-live=\"assertive\" aria-atomic=\"true\" data-delay='3000'> \
                                                        <div class=\"toast-header\"> \
                                                            <img src=\"{{ asset('storage/favicon.ico') }}\" style='width: 20px;'class=\"rounded mr-2\"> \
                                                            <strong class=\"mr-auto\">Informations</strong> \
                                                            <button type=\"button\" class=\"ml-2 mb-1 close\" data-dismiss=\"toast\" aria-label=\"Close\"> \
                                                                <span aria-hidden=\"true\">&times;</span> \
                                                            </button> \
                                                        </div> \
                                                        <div id='toast-content' class=\"toast-body\"> \
                                                            Vous vous êtes abonné avec succès ! \
                                                        </div> \
                                                    </div>"
                        $('#user_subscribed').toast('show');
                        setTimeout(() => {
                            toastContainer.removeChild(document.getElementById('user_subscribed'));
                        }, 3000);
                    } else {
                        const xhr = new XMLHttpRequest();
                        xhr.open('GET', "{{route('profile_unsubscribe', [$yourtubeur->id, $video->id])}}", true);
                        xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
                        xhr.onreadystatechange = function () {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                                aboBtn.innerHTML = "S'abonner<span id='nbSubscribers' class='ml-2'>" + (nbSubscribers - 1) + "</span>";
                            }
                        }
                        xhr.send();
                        //Toaster
                        const toastContainer = document.getElementById('toast-container')
                        toastContainer.innerHTML += "<div id='user_unsubscribed' class=\"toast\" role=\"alert\" aria-live=\"assertive\" aria-atomic=\"true\" data-delay='3000'> \
                                                        <div class=\"toast-header\"> \
                                                            <img src=\"{{ asset('storage/favicon.ico') }}\" style='width: 20px;'class=\"rounded mr-2\"> \
                                                            <strong class=\"mr-auto\">Informations</strong> \
                                                            <button type=\"button\" class=\"ml-2 mb-1 close\" data-dismiss=\"toast\" aria-label=\"Close\"> \
                                                                <span aria-hidden=\"true\">&times;</span> \
                                                            </button> \
                                                        </div> \
                                                        <div id='toast-content' class=\"toast-body\"> \
                                                            Vous vous êtes désabonné avec succès ! \
                                                        </div> \
                                                    </div>"
                        $('#user_unsubscribed').toast('show');
                        setTimeout(() => {
                            toastContainer.removeChild(document.getElementById('user_unsubscribed'));
                        }, 3000);
                    }
                }
            </script>
        </div>
        <div class="mt-3 mb-5 pl-4">
            <p>{{$video->description}}</p>
        </div>
        <div class="d-flex justify-content-between">
            <div>
                Catégorie : <a href="{{ route('category_show', $video->category_id) }}" title="Catégorie : {{$video->category_name}}"><span
                        class="badge badge-pill badge-info"
                        style="color: white">{{$video->category_name}}</span></a>
            </div>
            <div>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{route('video_show', $video->id)}}"
                   target="_blank" class="mr-1" title="Partager cette vidéo sur Facebook">
                    <button type="button" class="btn btn-secondary btn-sm"><i class="fab fa-facebook"
                                                                              style="margin-right: 5px;"></i>Facebook
                    </button>
                </a>
                <a href="https://twitter.com/intent/tweet?text=Cette vidéo pourrait vous intéresser : {{route('video_show', $video->id)}}"
                   target="_blank" class="mr-1" title="Partager cette vidéo sur Twitter">
                    <button type="button" class="btn btn-secondary btn-sm"><i class="fab fa-twitter"
                                                                              style="margin-right: 5px;"></i>Twitter
                    </button>
                </a>
                <a href="https://www.linkedin.com/shareArticle?url={{route('video_show', $video->id)}}" target="_blank"
                   class="mr-1" title="Partager cette vidéo sur Linkedin">
                    <button type="button" class="btn btn-secondary btn-sm"><i class="fab fa-linkedin"
                                                                              style="margin-right: 5px;"></i>Linkedin
                    </button>
                </a>
                <a href="mailto:?subject={{$video->title}}'&body=Cette vidéo pourrait vous intéresser : {{route('video_show', $video->id)}} via Yourtube.fr"
                   target="_blank" class="mr-1" title="Envoyer cette vidéo par mail">
                    <button type="button" class="btn btn-secondary btn-sm"><i class="fas fa-envelope"
                                                                              style="margin-right: 5px;"></i>Mail
                    </button>
                </a>
                <a data-toggle="collapse" href="#iframe" role="button" aria-expanded="false"
                   aria-controls="collapseExample" title="Intégrer cette vidéo à votre site">
                    <button type="button" class="btn btn-secondary btn-sm"><i class="fas fa-code"
                                                                              style="margin-right: 5px;"></i>Intégrer
                    </button>
                </a>
            </div>
        </div>
        <div class="collapse mt-2" id="iframe">
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
                            <img src="{{ asset('storage/default-user-avatar.png') }}" class="mr-3" alt="miniature"
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

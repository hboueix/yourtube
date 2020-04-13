@extends('layouts.app')
@section('content')
    @if (session('video_updated'))
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Vidéo mise en ligne avec succès !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    @if (session('video_deleted'))
        <div class="container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Vidéo supprimée avec succès !
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    <div class="container align-items-center">
        <div class="profile">
            <div class="col-md-3 text-center" style="margin-left: auto; margin-right: auto; margin-bottom: 40px;">
                <div class="profile">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        @if(strlen($profile->avatar) > 0)
                            <img src="{{ asset('storage/'. $profile->avatar) }}"
                                 style="width: 250px; height: 250px; border-radius: 100%">
                        @else
                            <img src="https://static.asianetnews.com/img/default-user-avatar.png"
                                 style="width: 250px; height: 250px">
                        @endif
                    </div>
                    <br>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            <h2>{{ $profile ?? '' ? $profile->first_name : '' }} {{ $profile ?? '' ? $profile->last_name : '' }}</h2>
                        </div>
                    </div>
                    <br>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    @if($profile->id == \Illuminate\Support\Facades\Auth::id())
                        <div>
                            <a href="{{ route('profile_edit') }}" title="Éditer mon profil">
                                <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt"
                                                                                        style="margin-right: 5px"></i>Éditer
                                    mon profil
                                </button>
                            </a>
                        </div>
                @endif
                <!-- END SIDEBAR BUTTONS -->
                </div>
            </div>
            <h3>Vidéos publiées</h3>
            <hr/>
            @if(sizeof($videos) == 0 && $profile->id == \Illuminate\Support\Facades\Auth::id())
                <div class="alert alert-warning" role="alert">
                    Vous n'avez pas publié de vidéo, <a href="{{ route('video_form') }}">publiez votre permière
                        vidéo</a> !
                </div>
            @elseif (sizeof($videos) == 0 && !($profile->id == \Illuminate\Support\Facades\Auth::id()))
                <div class="alert alert-warning" role="alert">
                    Cet utilisateur n'a pas encore publié de vidéos.
                </div>
            @endif
            @foreach ($videos as $video)
                <div class="media d-flex align-content-center flex-wrap">
                    <a href="{{route('video_show', $video->id)}}">
                        <div class="mr-3"
                             style="width: 300px; height: 200px; background-image: url('{{asset('storage/'. $video->miniature)}}'); background-position: center; background-size: cover">
                        </div>
                    </a>
                    <div class="media-body">
                        <a href="{{route('video_show', $video->id)}}"><h5
                                class="mt-1">{{ $video->title }}@if($video->is_valid == 0)
                                    <span class="badge badge-warning">En attente</span>
                                @endif</h5></a>
                        <p>
                            {{ $video->description }}
                        </p>
                        <p>
                            {{ $video->created_at }}
                        </p>
                    </div>

                    {{--@php(dd($video));--}}
                    <div class="text-center">
                        <div style="font-size: 20px;">
                            <span title="Nombre de likes" class="badge badge-secondary"> <i class="fas fa-thumbs-up"
                                                                                            style="margin-right: 10px"></i><span>{{ $video->likes }}</span></span>
                            <span title="Nom de dislikes" class="badge badge-secondary"> <i class="fas fa-thumbs-down"
                                                                                            style="margin-right: 10px"></i><span>{{ $video->dislikes }}</span></span>
                            <span title="Nombre de vues" class="badge badge-secondary">  <i class="fas fa-eye"
                                                                                            style="margin-right: 10px"></i><span>{{ $video->nbWatch }}</span></span>
                        </div>
                        <br>
                        @if($profile->id == \Illuminate\Support\Facades\Auth::id())
                            <a href="{{ route('video_edit', $video->id) }}">
                                <button type="submit" title="Modifier la vidéo" class="btn btn-outline-dark btn-sm"><i
                                        class="fas fa-pencil-alt"></i>
                                </button>
                            </a>
                            <a href="{{ route('video_destroy', $video->id) }}">
                                <button type="submit" title="Supprimer la vidéo" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </a>
                        @endif
                    </div>
                </div>
                <hr/>
            @endforeach
        </div>
    </div>
@endsection

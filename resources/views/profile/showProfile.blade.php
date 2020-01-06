@extends('layouts.app')
@section('content')
    @if (session('video_updated'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Vidéo mise en ligne avec succès !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('video_deleted'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Vidéo supprimée avec succès !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container align-items-center">
        <div class="profile">
            <div class="col-md-3 text-center" style="margin-left: auto; margin-right: auto; margin-bottom: 40px;">
                <div class="profile">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        @if(strlen($profile->avatar) > 0)
                            <img src="{{ asset('storage/'. $profile->avatar) }}" style="width: 250px; height: 250px; border-radius: 100%">
                        @else
                            <img src="https://static.asianetnews.com/img/default-user-avatar.png" style="width: 250px; height: 250px">
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
                            <a href="{{ route('profile_edit') }}"><button type="submit" class="btn btn-success btn-sm"><i class="fas fa-pencil-alt" style="margin-right: 5px"></i>Éditer profil</button></a>
                        </div>
                    @endif
                    <!-- END SIDEBAR BUTTONS -->
                </div>
            </div>
            <h3>Vidéos publiées</h3>
            <hr />
            @if(sizeof($videos) == 0)
                <div class="alert alert-warning" role="alert">
                    Vous n'avez pas publié de vidéo, <a href="{{ route('video_form') }}">publiez votre permière vidéo</a> !
                </div>
            @endif
            @foreach ($videos as $video)
            <div class="media">
                <div class="mr-3" style="width: 400px; height: 200px; background-image: url('{{asset('storage/'. $video->miniature)}}'); background-position: center; background-size: cover"></div>
                <div class="media-body" style="text-overflow:  ellipsis;  overflow: hidden !important;">
                    <a href="{{route('video_show', $video->id)}}"><h5 class="mt-1">{{ $video->title }}</h5></a>
                    <p>
                        {{ $video->description }}
                    </p>
                    <p>
                        {{ $video->created_at }}
                    </p>
                </div>
                {{--@php(dd($video));--}}
                <div class="text-center" style="width: 20%">
                    <button type="button" class="btn btn-success" style=" margin-bottom: 5px">
                        <i class="fas fa-thumbs-up" style="margin-right: 10px"></i><span>{{ $video->likes }}</span>
                    </button>
                    <button type="button" class="btn btn-danger" style=" margin-bottom: 5px">
                        <i class="fas fa-thumbs-down" style="margin-right: 10px"></i><span>{{ $video->dislikes }}</span>
                    </button>
                    <button type="button" class="btn btn-secondary" style="margin-bottom: 30px">
                        <i class="fas fa-eye" style="margin-right: 10px"></i><span>{{ $video->nbWatch }}</span>
                    </button>
                    @if($profile->id == \Illuminate\Support\Facades\Auth::id())
                        <div class="profile-userbuttons" style="margin-bottom: 5px">
                            <a href="{{ route('video_edit', $video->id) }}"><button type="submit" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt" style="margin-right: 5px"></i>Modifier</button></a>
                        </div>
                        <div class="profile-userbuttons">
                            <a href="{{ route('video_destroy', $video->id) }}"><button type="submit" class="btn btn-danger btn-sm" style="vertical-align: bottom"><i class="fas fa-trash-alt" style="margin-right: 10px"></i>Supprimer</button></a>
                        </div>
                    @endif
                </div>
            </div>
            <hr />
            @endforeach
        </div>
    </div>
@endsection

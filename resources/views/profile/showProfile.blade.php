@extends('layouts.app')

@section('content')
    <div class="container align-items-center">
        <div class="profile">
            <div class="col-md-3 text-center" style="margin-left: auto; margin-right: auto; margin-bottom: 40px;">
                <div class="profile">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        @if(isset($profile->image))
                            <img src="{{ asset('storage/images/'. $profile->image) }}" style="width: 250px; height: 250px">
                        @else
                            <img src="https://static.asianetnews.com/img/default-user-avatar.png" style="width: 250px; height: 250px">
                        @endif
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            {{ $profile ?? '' ? $profile->first_name : '' }} {{ $profile ?? '' ? $profile->last_name : '' }}
                        </div>
                        <div class="profile-usertitle-job">
                            {{ $profile ?? '' ? substr($profile->dateOfBirth, 0, 10) : '' }}
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">
                        <a href="{{ route('profile_edit', $user_id) }}"><button type="submit" class="btn btn-success btn-sm">Éditer profil</button></a>
                        <a href="{{ route('profile_destroy', $user_id) }}"><button type="submit" class="btn btn-danger btn-sm">Supprimer le profil</button></a>
                    </div>
                    <!-- END SIDEBAR BUTTONS -->
                </div>
            </div>
            <h3>Vidéos publiées</h3>
            <hr />
            @foreach ($videos as $video)
            <div class="media">
                <img src="{{ asset('storage/images/'. $video->image) }}" class="mr-3" alt="miniature">
                <div class="media-body" style="text-overflow:  ellipsis;  overflow: hidden !important;">
                    <h5 class="mt-1">{{ $video->title }}</h5>
                    <p>
                        {{ $video->description }}
                    </p>
                    <p>
                        Sortie le : {{ $video->created_at }}
                    </p>
                </div>
                <div class="text-center" style="width: 9%;">
                    <button type="button" class="btn btn-secondary" style=" margin-bottom: 14px">
                        Vues <span class="badge badge-light">79</span>
                    </button>
                    <button type="button" class="btn btn-success" style=" margin-bottom: 14px">
                        J'aime <span class="badge badge-light">{{ $video->likes }}</span>
                    </button>
                    <button type="button" class="btn btn-danger">
                        Dislikes <span class="badge badge-light">{{$video->dislikes}}</span>
                    </button>
                </div>
            </div>
            <hr />
            @endforeach
        </div>
    </div>
@endsection

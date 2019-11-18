@extends('layouts.app')

@section('content')
<div class="container">
    @if (isset($profile) == false)
        <div class="alert alert-warning" role="alert">
            Attention, votre profil n'est pas configuré !
        </div>
    @endif
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    <img src="{{$profile ?? '' ? asset('storage/images/'.$profile->image) : ''}}" style="width: 250px; height: 250px">
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
                    <a href="{{ route('profile_edit') }}"><button type="submit" class="btn btn-success btn-sm">Éditer profil</button></a>
                    <a href="{{ route('profile_destroy') }}"><button type="submit" class="btn btn-danger btn-sm">Supprimer le profil</button></a>
                </div>
                <!-- END SIDEBAR BUTTONS -->
            </div>
        </div>
    </div>
</div>
@endsection

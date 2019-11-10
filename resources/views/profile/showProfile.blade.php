@extends('layouts.app')

@section('content')
<div class="container" style="border: 1px solid">
    <div class="row profile">
        <div class="col-md-3">
            <div class="profile-sidebar">
                <!-- SIDEBAR USERPIC -->
                <div class="profile-userpic">
                    @php
                    var_dump($profile->image);
                    @endphp
                    <img src="{{ asset('storage/'.$profile->image) }}" style="width: 250px; height: 250px">
                    <form method="post" action="{{ route('editAvatar') }}">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="image">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                            @csrf
                            <button type="submit" class="btn btn-primary btn-sm">Changer avatar</button>
                        </div>
                    </form>
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
                    <a href="{{ route('edit') }}"><button type="submit" class="btn btn-success btn-sm">Éditer profil</button></a>
                    <a href="{{ route('delete') }}"><button type="submit" class="btn btn-danger btn-sm">Supprimer le profil</button></a>
                </div>
                <!-- END SIDEBAR BUTTONS -->
            </div>
        </div>
    </div>
</div>
@endsection

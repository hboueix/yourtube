@extends('layouts.app')

@section('content')
    <div class="container align-items-center">
        <div class="profile">
            <div class="col-md-3 text-center" style="margin-left: auto; margin-right: auto; margin-bottom: 40px;">
                <div class="profile">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img src="{{ asset('storage/images/'.$profile->user_id . '/'.$profile->image) }}" style="border: 3px solid; width: 250px; height: 250px">
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
                        <a href="{{ route('profile_destroy') }}"><button type="submit" class="btn btn-danger btn-sm">Supprimer le profil</button></a>
                    </div>
                    <!-- END SIDEBAR BUTTONS -->
                </div>
            </div>
            <h3>Vidéos publiées</h3>
            <hr />
            <div class="media">
                <img src="https://via.placeholder.com/200x140" class="mr-3" alt="miniature">
                <div class="media-body" style="text-overflow:  ellipsis; max-height: 130px; overflow: hidden !important;">
                    <h5 class="mt-1">PRANK CLOWN ASSASSIN (CA TOURNE MAL)</h5>
                    <p>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        Messors ortum in lutetia!Festus fidess ducunt ad equiso.Magnum, ferox lixas acceleratrix gratia de castus, primus devirginato.Dexter, noster nutrixs hic imperium de audax, gratis tus.Ubi est bassus calcaria?
                        When> one avoids conclusion and silence, one is able to discover advice.Never rob a sail.Bi-color urias ducunt ad bulla.Zirbuss sunt advenas de altus elevatus.
                    </p>
                </div>
                <div class="text-center" style="width: 9%;">
                    <button type="button" class="btn btn-secondary" style=" margin-bottom: 14px">
                        Vues <span class="badge badge-light">79</span>
                    </button>
                    <button type="button" class="btn btn-success" style=" margin-bottom: 14px">
                        J'aime <span class="badge badge-light">39</span>
                    </button>
                    <button type="button" class="btn btn-danger">
                        Dislikes <span class="badge badge-light">2</span>
                    </button>
                </div>
            </div>
            <hr />
            <div class="media">
                <img src="https://via.placeholder.com/200x140" class="mr-3" alt="miniature">
                <div class="media-body" style="text-overflow:  ellipsis; max-height: 130px; overflow: hidden !important;">
                    <h5 class="mt-1">ICE BUCKET CHALLENGE HARDCORE EN COUPLE (je m'étouffe!!!)</h5>
                    <p>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        Messors ortum in lutetia!Festus fidess ducunt ad equiso.Magnum, ferox lixas acceleratrix gratia de castus, primus devirginato.Dexter, noster nutrixs hic imperium de audax, gratis tus.Ubi est bassus calcaria?
                        When> one avoids conclusion and silence, one is able to discover advice.Never rob a sail.Bi-color urias ducunt ad bulla.Zirbuss sunt advenas de altus elevatus.
                    </p>
                </div>
                <div class="text-center" style="width: 9%;">
                    <button type="button" class="btn btn-secondary" style=" margin-bottom: 14px">
                        Vues <span class="badge badge-light">215</span>
                    </button>
                    <button type="button" class="btn btn-success" style=" margin-bottom: 14px">
                        J'aime <span class="badge badge-light">76</span>
                    </button>
                    <button type="button" class="btn btn-danger">
                        Dislikes <span class="badge badge-light">8</span>
                    </button>
                </div>
            </div>
            <hr />
            <div class="media">
                <img src="https://via.placeholder.com/200x140" class="mr-3" alt="miniature">
                <div class="media-body" style="text-overflow:  ellipsis; max-height: 130px; overflow: hidden !important;">
                    <h5 class="mt-1">Let's play narratif : SNAKE [4/10]</h5>
                    <p>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        Messors ortum in lutetia!Festus fidess ducunt ad equiso.Magnum, ferox lixas acceleratrix gratia de castus, primus devirginato.Dexter, noster nutrixs hic imperium de audax, gratis tus.Ubi est bassus calcaria?
                        When> one avoids conclusion and silence, one is able to discover advice.Never rob a sail.Bi-color urias ducunt ad bulla.Zirbuss sunt advenas de altus elevatus.
                    </p>
                </div>
                <div class="text-center" style="width: 9%;">
                    <button type="button" class="btn btn-secondary" style=" margin-bottom: 14px">
                        Vues <span class="badge badge-light">9</span>
                    </button>
                    <button type="button" class="btn btn-success" style=" margin-bottom: 14px">
                        J'aime <span class="badge badge-light">1</span>
                    </button>
                    <button type="button" class="btn btn-danger">
                        Dislikes <span class="badge badge-light">6</span>
                    </button>
                </div>
            </div>
            <hr />
        </div>
    </div>
@endsection

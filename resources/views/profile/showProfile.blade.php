@extends('layouts.app')

@section('content')
<center>
    <div class="container" style="border: 1px solid">
        <div class="row profile">
            <div class="col-md-12">
                <div class="profile-sidebar">
                    <!-- SIDEBAR USERPIC -->
                    <div class="profile-userpic">
                        <img src="//placehold.it/150" class="mx-auto img-fluid img-circle d-block" alt="avatar">
                    </div>
                    <!-- END SIDEBAR USERPIC -->
                    <!-- SIDEBAR USER TITLE -->
                    <div class="profile-usertitle">
                        <div class="profile-usertitle-name">
                            Marcus Doe
                        </div>
                        <div class="profile-usertitle-job">
                            Developer
                        </div>
                    </div>
                    <!-- END SIDEBAR USER TITLE -->
                    <!-- SIDEBAR BUTTONS -->
                    <div class="profile-userbuttons">
                        <button type="button" class="btn btn-success btn-sm">Follow</button>
                        <a href="{{ route('edit') }}"><button type="submit" class="btn btn-danger btn-sm">Éditer profil</button></a>                    </div>
                    <!-- END SIDEBAR BUTTONS -->
                </div>
            </div>
        </div>
    </div>
</center>
@endsection

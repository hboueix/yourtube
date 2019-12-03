@extends('layouts.app')

@section('content')
    @if (session('account_deleted'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Compte supprimé avec succès !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Liste utilisateurs</div>
                    <div class="card-body">
                        @foreach ($profile as $profiler)
                            <div class="media">
                                <img src="{{ asset('storage/' . $profiler->avatar) }}" class="mr-3" alt="miniature"
                                     style="height: 120px; width: 120px">
                                <div class="media-body" style="text-overflow:  ellipsis;  overflow: hidden !important;">
                                    <h5 class="mt-1"> | {{ $profiler->name }}</h5>
                                    <h6 class="mt-1">{{ $profiler->email }}</h6>
                                    <p>
                                        {{ $profiler->dateOfBirth }}
                                    </p>
                                    <p>
                                        Crée le : {{ $profiler->created_at }}
                                    </p>
                                </div>
                                <div class="text-center" style="width: 15%;">
                                    <a href="{{ route('profile_show', $profiler->name) }}">
                                        <button type="button" class="btn btn-success" style=" margin: 5px">
                                            <i class="fas fa-user"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('admin_profile_destroy', $profiler->id) }}">
                                        <button type="button" class="btn btn-danger">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <hr/>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

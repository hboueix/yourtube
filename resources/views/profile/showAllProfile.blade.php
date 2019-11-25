@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Liste utilisateurs</div>
                    <div class="card-body">
                        @foreach ($profile as $profiler)
                            <div class="media">
                                <img src="{{ asset('storage/images/' . $profiler->image) }}" class="mr-3" alt="miniature" style="height: 150px; width: 150px">
                                <div class="media-body" style="text-overflow:  ellipsis;  overflow: hidden !important;">
                                    <h5 class="mt-1">{{ $profiler->name }}</h5>
                                    <h6 class="mt-1">{{ $profiler->email }}</h6>
                                    <p>
                                        {{ $profiler->dateOfBirth }}
                                    </p>
                                    <p>
                                        Crée le : {{ $profiler->created_at }}
                                    </p>
                                </div>
                                <div class="text-center" style="width: 25%;">
                                    <a href="{{ route('profile_show', $profiler->id) }}"><button type="button" class="btn btn-success" style=" margin-bottom: 14px">
                                        Voir le profil
                                    </button></a>
                                    <button type="button" class="btn btn-danger">
                                        Supprimer le profil
                                    </button>
                                </div>
                            </div>
                            <hr />

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

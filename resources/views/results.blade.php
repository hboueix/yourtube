@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-body">
        <h4>Résultats pour : {{$search}}</h4>
        <hr/>
        <div class="row">
            @foreach ($profiles as $profiler)
                <div class="media">
                    @if(strlen($profiler->avatar) > 0)
                        <img src="{{ asset('storage/' . $profiler->avatar) }}" class="mr-3" alt="miniature"
                                width="80">
                    @else
                        <img src="https://static.asianetnews.com/img/default-user-avatar.png"
                                width="80" style="margin-right: 20px">
                    @endif
                    <div class="media-body" style="text-overflow:  ellipsis;  overflow: hidden !important;">
                        <h5 class="mt-1"><b
                                style="text-transform: capitalize">{{ $profiler->role_name }}</b>
                            | {{ $profiler->name }}</h5>

                        <h6 class="mt-1">{{ $profiler->email }}</h6>
                        <p>
                            {{ $profiler->dateOfBirth }}
                        </p>
                        <p>
                            Crée le : {{ $profiler->created_at }}
                        </p>
                    </div>
                </div>
                <hr/>
            @endforeach
            @foreach($videos as $video)
            <div class="col-sm-12">
                <div class="col-sm-4">
                    <a href="{{ route('video_show', $video->id) }}"
                        style="text-decoration: none; color: inherit">
                        <div
                            style="width: 100%; height: 200px; background-image: url('{{asset('storage/'. $video->miniature)}}'); background-position: center; background-size: cover">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $video->title }}</h5>
                        </div>
                    </a>
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="badge badge-pill badge-info">{{$video->category_name}}</span>
                        <span><i class="fas fa-eye mr-1"></i>{{$video->nbWatch}}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
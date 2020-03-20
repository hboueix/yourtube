@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-body">
        <h4>Résultats pour : {{$search}}</h4>
        <hr/>
        <div class="row">
            @foreach ($profiles as $profiler)
                <div class="card w-50 align-self-center align-items-center">
                    <a href="{{ route('profile_show', $profiler->name) }}" style="text-decoration: none; color: inherit;">
                    @if(strlen($profiler->avatar) > 0)
                        <img src="{{ asset('storage/' . $profiler->avatar) }}" class="mt-3" alt="miniature" style="border-radius: 100%;max-height: 80px;"
                                width="80">
                    @else
                        <img src="https://static.asianetnews.com/img/default-user-avatar.png" class="mt-3" alt="miniature" style="border-radius: 100%;max-height: 80px;"
                                width="80">
                    @endif
                    <div style="text-align:center; text-overflow:  ellipsis;  overflow: hidden !important;">
                        <h5 class="mt-1"><b>{{ $profiler->name }}</b></h5>
                        </a>
                        @if($profiler->subscribers > 0)
                            @if($profiler->subscribers == 1)
                            <p>{{ $profiler->subscribers }} abonné</p>
                            @else
                            <p>{{ $profiler->subscribers }} abonnés</p>
                            @endif
                        @else
                            <p>Pas d'abonné</p>
                        @endif
                    </div>
                </div>
            @endforeach
            <div class="col-sm-12 mb-3"></div>
            @foreach($videos as $video)
            <div class="col-sm-12">
                <div class="card w-100" style="display: inline-block;">
                    <a href="{{ route('video_show', $video->id) }}"
                        style="text-decoration: none; color: inherit">
                            <img class="card-img-left mr-3" style="float:left; width: 25%;" src="{{asset('storage/'. $video->miniature)}}"></img>
                        <div class="card-body">
                            <h5 class="card-title">{{ $video->title }}</h5>
                            <span><i class="fas fa-eye mr-1"></i>{{$video->nbWatch}}</span>
                        </div>
                        <div>
                            <p>{{ $video->description }}</p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection

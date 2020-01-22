@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card-body">
        <h4>Résultats pour : {{$search}}</h4>
        <hr/>
        <div class="row">
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
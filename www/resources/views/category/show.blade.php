@extends('layouts.app')
@section('content')
    <div class="container">
        <h2>Catégorie : {{ $category_name->title }}</h2>
        <span>{{sizeof($videos)}} @if(sizeof($videos) <= 1) résultat @else résultats @endif</span>
        <hr>
        @foreach($videos as $video)
            <div class="mb-3 d-flex">
                <a href="{{ route('video_show', $video->id) }}"
                   style="text-decoration: none; color: inherit">
                    <div
                        style="width: 300px; height: 200px; background-image: url('{{asset('storage/'. $video->miniature)}}'); background-position: center; background-size: cover">
                    </div>
                </a>
                <div>
                    <a href="{{ route('video_show', $video->id) }}"
                       style="color: inherit">
                        <h4
                            class="card-title ml-2">{{ $video->title }}</h4></a>
                    <p class="ml-3">
                        {{$video->description}}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
@endsection

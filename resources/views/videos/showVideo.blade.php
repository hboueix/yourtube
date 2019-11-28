@extends('layouts.app')

@section('content')
    <div style="width: 80%;margin-left: auto; margin-right: auto">
        <div class="embed-responsive embed-responsive-21by9">
            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/zpOULjyy-n8?rel=0"></iframe>
        </div>

        <div style="margin-top: 20px">
            <div class="text-left" style="width: 80%; float:left;">
                <h2>{{$videos->title}}</h2>
                <button type="button" class="btn btn-success"><i class="fas fa-thumbs-up" style="margin-right: 10px"></i>J'aime</button>
                <button type="button" class="btn btn-danger"><i class="fas fa-thumbs-down" style="margin-right: 10px"></i>J'aime pas</button>
            </div>
            <div class="text-right" style="width: 20%; float: left;">
                <h3>{{$videos->nbWatch}} vues</h3>
            </div>
        </div>
        <div class="text-left" style="border: 1px solid; margin-top: 150px">
            <img src="{{ asset('/storage/', $videos->avatar)}}">
            <h4>{{$videos->last_name}}</h4>
        </div>
    </div>
@endsection

@extends('layouts.app')
@section('content')
    @if (session('video_deleted'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Vidéo supprimée avec succès !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('comments_deleted'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Commentaire supprimé avec succès !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container">
        {{-- Videos block --}}
        <div class="row justify-content-center mb-3">
                <div class="card table-responsive">
                    <div class="card-header">Vidéos en attente</div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Miniature</th>
                            <th scope="col">Titre</th>
                            <th scope="col">Description</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($videos as $video)
                            <tr>
                                <td><img src="{{asset('storage/' . $video->miniature)}}" width="100"></td>
                                <td>{{$video->title}}</td>
                                <td>{{$video->description}}</td>
                                <td class="text-center">
                                    <a href="{{ route('video_approve', $video->id) }}">
                                        <button type="button" class="btn btn-success"><i class="fas fa-check"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('reportings_destroy', $video->id) }}">
                                    <button type="button" class="btn btn-danger"><i class="fas fa-times"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
        </div>
        {{-- Reports block --}}
        <div class="row justify-content-center mb-3">
                <div class="card table-responsive">
                    <div class="card-header">Derniers signalements</div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Utilisateur</th>
                            <th scope="col">Vidéo</th>
                            <th scope="col">Signalement</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reports as $report)
                            <tr>
                                <td>{{$report->name}}</td>
                                <td>{{$report->title}}</td>
                                <td>{{$report->content}}</td>
                                <td class="text-center">
                                    <a href="{{ route('video_show', $report->video_id) }}">
                                        <button type="button" class="btn btn-success" style="margin-bottom: 5px">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </a>
                                    <a href="{{ route('reportings_destroy', $report->video_id) }}">
                                        <button type="button" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
        {{-- Comments block --}}
        <div class="row justify-content-center mb-3">
                <div class="card table-responsive">
                    <div class="card-header">Derniers commentaires</div>
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">Utilisateur</th>
                            <th scope="col">Vidéo</th>
                            <th scope="col">Commentaire</th>
                            <th scope="col">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td>{{$comment->name}}</td>
                                <td>{{$comment->title}}</td>
                                <td>{{$comment->content}}</td>
                                <td class="text-center">
                                    <a href="{{ route('comments_destroy', $comment->id) }}">
                                        <button type="button" class="btn btn-danger"><i class="fas fa-trash"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
            </div>
        </div>
        {{-- Users block --}}
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card table-responsive">
                    <div class="card-header">Liste utilisateurs</div>
                    <div class="card-body">
                        @foreach ($profile as $profiler)
{{--                            @php(dd($profile));--}}
                            <div class="media">
                                <img src="{{ asset('storage/' . $profiler->avatar) }}" class="mr-3" alt="miniature"
                                     style="height: 120px; width: 120px">
                                <div class="media-body" style="text-overflow:  ellipsis;  overflow: hidden !important;">
                                    <h5 class="mt-1"> <b style="text-transform: capitalize">{{ $profiler->role_name }}</b> | {{ $profiler->name }}</h5>
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

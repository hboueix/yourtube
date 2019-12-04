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
        <div class="row justify-content-center" style="margin-bottom: 20px">
            <div class="col-md-8">
                <div class="card table-responsive">
                    <div class="card-header">Liste signalements</div>
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
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card table-responsive">
                    <div class="card-header">Liste commentaires</div>
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
                                <td>{{$report->name}}</td>
                                <td>{{$report->title}}</td>
                                <td>{{$comment->content}}</td>
                                <td class="text-center">
                                    <a href="{{ route('comments_destroy', $comment->id) }}">
                                        <button type="button" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

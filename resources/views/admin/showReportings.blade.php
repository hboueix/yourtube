@extends('layouts.app')
@section('content')
    @if (session('video_deleted'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Vidéo a été supprimé avec succès !
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
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
                            <td><a href="{{ route('video_show', $report->video_id) }}"><button type="button" class="btn btn-success btn-sm" style="margin-bottom: 5px">Voir le contenu</button></a>
                                <a href="{{ route('reportings_destroy', $report->video_id) }}"><button type="button" class="btn btn-danger btn-sm">Supprimer</button></a>
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

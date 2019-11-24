@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Partager une vidéo') }}</div>
                    <form method="post" action="{{ route('video_upload', $user_id ?? '') }}" enctype="multipart/form-data" style="margin: 5px">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" name="image">
                            <label class="custom-file-label" for="customFile">Choisir la miniature</label>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Titre</label>
                            <input type="text" class="form-control" id="title" placeholder="Titre putaclic" name="title" value="{{ $profile ?? '' ? $profile->last_name : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="first_name">Description</label>
                            <textarea type="text" class="form-control" id="first_name" placeholder="Description" name="description" value="{{ $profile ?? '' ? $profile->first_name : '' }}" required></textarea>
                        </div>
                        <input type="hidden" name="id" value="">
                        @csrf
                        <button type="submit" class="btn btn-primary">Mettre en ligne</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

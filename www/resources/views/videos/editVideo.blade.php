@extends('layouts.app')

@section('content')
    <div class="container" style="margin-left: auto; margin-right: auto">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Editer sa vidéo') }}</div>
                    <form method="post" action="{{ route('video_update', $video->id) }}" enctype="multipart/form-data"
                          style="margin: 5px">
                        <div class="custom-file">
                            <label class="custom-file-label" for="miniature">Changer la miniature</label>
                            <input type="file" class="custom-file-input" id="miniature" name="miniature">
                        </div>
                        <div class="form-group">
                            <label for="last_name">Titre de la vidéo</label>
                            <input type="text" class="form-control" id="last_name" placeholder="Titre de la vidéo"
                                   name="title"
                                   value="{{$video->title}}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" class="form-control" id="description"
                                      placeholder="Description de votre vidéo" name="description"
                                      required>{{$video->description}}</textarea>
                        </div>
                        <input type="hidden" name="id" value="">
                        @csrf
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

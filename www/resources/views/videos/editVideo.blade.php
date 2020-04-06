@extends('layouts.app')

@section('content')
    <div class="container" style="margin-left: auto; margin-right: auto">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Editer sa vidéo') }}</div>
                    <form method="post" action="{{ route('video_update', $video->id) }}" enctype="multipart/form-data"
                          style="margin: 5px">
                        <label for="miniature">Changer la miniature</label>
                        <div class="custom-file mb-2">
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
                        <div class="form-group">
                            <select class="form-control d-inline w-100"
                                    style="width: 70%" name="category">
                                @foreach($categories as $category)
                                    <option @if($video->category_id === $category->id) selected
                                            @endif value="{{ $category->id }}">{{ ucfirst($category->title) }}</option>
                                @endforeach
                            </select>
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

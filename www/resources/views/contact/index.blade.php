@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if(session('send'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Votre message a été envoyé avec succès !
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">{{ __('Nous contacter') }}</div>
                    <form method="post" action="{{ route('contact_send') }}" enctype="multipart/form-data"
                          style="margin: 5px">
                        <div class="form-group">
                            <label for="title">Prénom</label>
                            <input type="text" class="form-control" placeholder="Prénom" name="firstname" value="{{ $profile ?? '' ? $profile->title : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="title">Nom</label>
                            <input type="text" class="form-control" placeholder="Nom" name="lastname" value="{{ $profile ?? '' ? $profile->title : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="title">Email</label>
                            <input type="email" class="form-control" placeholder="Adresse email" name="email" value="{{ $profile ?? '' ? $profile->title : '' }}" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea type="text" class="form-control"
                                      placeholder="Message que vous souhaitez nous faire parvenir" name="message"
                                      required></textarea>
                        </div>
                        @csrf
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger m-2">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

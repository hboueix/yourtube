@extends('layouts.app')
@section('content')
<form method="post" action="{{ route('profile_update') }}" style="margin: 5px">
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" id="last_name" placeholder="Enter last name" name="last_name" value="{{ $profile ?? '' ? $profile->last_name : '' }}">
    </div>
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" id="first_name" placeholder="Enter first name" name="first_name" value="{{ $profile ?? '' ? $profile->first_name : '' }}">
    </div>
    <div class="form-group">
        <label for="last_name">Date de naissance</label>
        <input type="date" id="age" placeholder="Definissez une date de naissance" class="form-control" name="birthday" value="{{ $profile ?? '' ? substr($profile->dateOfBirth, 0, 10) : '' }}">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Adresse Email</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email" value="{{ Auth::user() ?? '' ? Auth::user()->email : '' }}">
    </div>
    <input type="hidden" name="id" value="">
    @csrf
    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>
@endsection

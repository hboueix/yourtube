@extends('layouts.app')

@section('content')
<form method="post">
    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" id="last_name" placeholder="Enter last name" value="">
    </div>
    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" id="first_name" placeholder="Enter first name" value="">
    </div>
    <div class="form-group">
        <label for="last_name">Date de naissance</label>
        <input type="date" name="age" id="age" placeholder="Definissez une date de naissance" class="form-control" value="">
    </div>
    <div class="form-group">
        <label for="exampleInputEmail1">Adresse Email</label>
        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Mot de passe</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    </div>
    <input type="hidden" name="id" value="">
    @csrf
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection

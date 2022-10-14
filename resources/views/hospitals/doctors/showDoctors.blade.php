@extends('layouts.myNav')

@section('content')

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Title</th>
            <th scope="col">Gender</th>
            <th scope="col">Operation</th>
            <th> <a type="button" class="btn btn-dark" href="{{route('showHospitals')}}">Hospitals</a></th>
        </tr>
        </thead>
        <tbody>
        @if(isset($doctors) && $doctors->count() > 0)
        @foreach($doctors as $doctor)
            <tr>
                <th scope="row">{{$doctor->id}}</th>
                <td>{{$doctor->name}}</td>
                <td>{{$doctor->title}}</td>
                <td>{{$doctor->gender}}</td>
                <td>
                    <a type="button" class="btn btn-primary" href="{{route('showServices', $doctor->id)}}">Show services</a>
                    <a type="button" class="btn btn-danger" href="{{route('deleteDoctor', $doctor->id)}}">Delete doctor</a>
                </td>
            </tr>
        @endforeach
        @endif
        </tbody>
    </table>

    <div class="container">
    <form method="POST" action="{{route('addDoctors')}}" enctype="multipart/form-data">

        @csrf
        {{--<input name = "_token" value = "{{csrf_token()}}">--}}

        <input type="hidden" class="form-control" value="{{$hospital_id}}" name="hospital_id">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Doctor Name</label>
            <input type="text" class="form-control" name="name" placeholder="name">

            <small id="name_error" class="form-text text-danger"></small>

        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Doctor title</label>
            <input type="text" class="form-control" name="title" placeholder="title">

            <small id="price_error" class="form-text text-danger"></small>

        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Doctor Gender</label>
            <input type="text" class="form-control" name="gender" placeholder="1 => male, 2 => female">

            <small id="detailes_error" class="form-text text-danger"></small>

        </div>
        <button id="save_offer" class="btn btn-primary">Add Doctor</button>
    </form>
    </div>

@stop

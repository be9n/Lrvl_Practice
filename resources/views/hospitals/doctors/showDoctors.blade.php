@extends('layouts.myNav')

@section('content')

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Title</th>
            <th scope="col">Operation</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($doctors) && $doctors->count() > 0)
        @foreach($doctors as $doctor)
            <tr>
                <th scope="row">{{$doctor->id}}</th>
                <td>{{$doctor->name}}</td>
                <td>{{$doctor->title}}</td>
                <td>
                    <a type="button" class="btn btn-dark" href="{{route('showHospitals')}}">Hospitals</a>
                    {{-- <a type="button" class="btn btn-danger" href="{{route('offers.delete',$offer->id)}}">Delete</a>--}}
                </td>
            </tr>
        @endforeach
        @endif
        </tbody>
    </table>
    @if(Session::has('success'))
        <div class="alert alert-primary" role="alert">
            {{Session::get('success')}}
        </div>
    @elseif(Session::has('fail'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('fail')}}
        </div>
    @endif

@stop

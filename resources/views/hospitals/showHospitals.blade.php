@extends('layouts.myNav')

@section('content')

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Operation</th>
        </tr>
        </thead>
        <tbody>
        @if(isset($hospitals) && $hospitals->count() > 0)
        @foreach($hospitals as $hospital)
            <tr>
                <th scope="row">{{$hospital->id}}</th>
                <td>{{$hospital->name}}</td>
                <td>{{$hospital->address}}</td>
                <td>
                    <a  class="btn btn-dark" href="{{route('showDoctors', $hospital->id)}}">Show doctors</a>
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

@extends('layouts.myNav')

@section('content')


    <table class="table">
        <thead>
        <tr>
            <th>الخدمات</th>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <td> <a class="btn btn-dark" href="{{route('showHospitals')}}">Hospitals</a></td>

        </tr>
        </thead>
        <tbody>
       @if(isset($data['services']) && $data['services']->count() > 0)
        @foreach($data['services'] as $service)
            <tr>
                <th scope="row"></th>
                <th scope="row">{{$service->id}}</th>
                <td>{{$service->name}}</td>
                <td>
                   <a class="btn btn-danger" href="{{route('deleteService', [$service->id, $doctor_id])}}">Delete</a>
                </td>
            </tr>
        @endforeach
        @endif

        </tbody>
    </table>
    <td> <a class="btn btn-dark" href="{{route('showDoctors', $hospital_id)}}">Doctors</a></td>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table class="table">
        <thead>
        <tr>
            <th>خدمات شاغرة</th>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th> <a type="button" class="btn btn-dark" href="{{route('showHospitals')}}">Hospitals</a></th>
        </tr>
        </thead>
        <tbody>
        @if(isset($emptyServices) && $emptyServices->count() > 0)
            @foreach($emptyServices as $emptyService)
                <tr>
                    <th scope="row"></th>
                    <th scope="row">{{$emptyService->id}}</th>
                    <td>{{$emptyService->name}}</td>
                    <td>
                        <a type="button" class="btn btn-primary" href="{{route('addService', [$emptyService->id, $doctor_id])}}">Add service</a>
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

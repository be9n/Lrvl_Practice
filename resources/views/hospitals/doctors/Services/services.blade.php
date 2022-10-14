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

    <div class="container">
        <form method="POST" action="{{route('addSelectService',$doctor_id)}}">
            @csrf
    <div class="form-group">
        <label for="exampleInputEmail">Choose the service</label>

        <select class="form-control" name="servicesIds[]" multiple>
            @foreach($data['emptyServices'] as $emptyService)
                <option value="{{$emptyService->id}}">{{$emptyService -> name}}</option>
            @endforeach
        </select>
    </div>
        <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>



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
        @if(isset($data['emptyServices']) && $data['emptyServices']->count() > 0)
            @foreach($data['emptyServices'] as $emptyService)
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

@stop

@extends('layouts.myNav')

@section('content')

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Address</th>
            <th scope="col">Doctor count</th>
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
                @if($hospital->doctors->count() < 2 && $hospital->doctors->count() > 0)
                <td>({{$hospital->doctors->count()}}) Doctor</td>
                @else($hospital->doctors->count() >= 2)
                    <td>({{$hospital->doctors->count()}}) Doctors</td>
                @endif
                <td>
                    <a  class="btn btn-dark" href="{{route('showDoctors', $hospital->id)}}">Show doctors</a>
                    <a hospital_id = "{{$hospital->id}}" class="delete_btn btn btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
        @endif
        </tbody>
    </table>

    <div class="container">
        <form method="POST" action="{{route('addHospital')}}" enctype="multipart/form-data">
            @csrf
            {{--<input name = "_token" value = "{{csrf_token()}}">--}}

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Hospital name</label>
                <input type="text" class="form-control" name="name" placeholder="name">

                <small id="name_error" class="form-text text-danger"></small>

            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Hospital address</label>
                <input type="text" class="form-control" name="address" placeholder="address">

                <small id="price_error" class="form-text text-danger"></small>

            </div>
            <button id="save_offer" class="btn btn-primary">Add Hospital</button>
        </form>
    </div>

@stop

@section('scripts')

    <script>
        $(document).on('click', '.delete_btn', function (e) {
            e.preventDefault();

            var hospital_id = $(this).attr('hospital_id');
            var $tr = $(this).closest('tr');

            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('deleteHospital')}}",
                data: {
                    '_token': "{{csrf_token()}}",
                    'id':hospital_id
                },
                success: function (data) {
                    if (data.status == true) {
                        $('#success_msg').show();
                    }
                    //Stackoverflow

                    $tr.find('td').fadeOut(500,function(){
                        $tr.remove();
                    });

                }, error: function (reject) {

                }
            });
        });
    </script>
@stop

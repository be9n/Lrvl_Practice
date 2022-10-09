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

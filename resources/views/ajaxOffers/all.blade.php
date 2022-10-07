@extends('layouts.myNav')

@section('content')


    <div class="alert alert-success" id="success_msg" style="display:none">
        deleted Successfully
    </div>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Detailes</th>
            <th scope="col">Photo</th>
            <th scope="col">Operation</th>
        </tr>
        </thead>
        <tbody>
        @foreach($offers as $offer)
            <tr>
                <th scope="row">{{$offer->id}}</th>
                <td>{{$offer->name}}</td>
                <td>{{$offer->price}}</td>
                <td>{{$offer->detailes}}</td>
                <td><img  style="width: 90px; height: 90px;" src="{{asset('images/offers/'.$offer->photo)}}"></td>
                <td>
                    <br>
                    <a class="btn btn-dark" href="{{route('ajax.offers.edit',$offer->id)}}">Edit</a>
                    <a  offer_id="{{$offer->id}}" class="delete_btn btn btn-danger" href="{{route('offers.delete',$offer->id)}}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@stop

        @section('scripts')

            <script>
                $(document).on('click', '.delete_btn', function (e) {
                    e.preventDefault();

                   var offer_id = $(this).attr('offer_id');
                   var $tr = $(this).closest('tr');

                    $.ajax({
                        type: 'post',
                        enctype: 'multipart/form-data',
                        url: "{{route('ajax.offers.delete')}}",
                        data: {
                            '_token': "{{csrf_token()}}",
                            'id':offer_id
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

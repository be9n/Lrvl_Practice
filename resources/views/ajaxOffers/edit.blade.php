@extends('layouts.myNav')

@section('content')
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                Edit Offer
            </div>

            <div class="alert alert-success" id="success_msg" style="display:none">
                updated Successfully
            </div>

            <form method="POST" action="{{route('offers.update', $offer-> id)}}" id="offerForm" enctype="multipart/form-data">
                @csrf
                {{-- <meta name="csrf-token" content="{{csrf_token()}}" />--}}
                {{--<input name = "_token" value = "{{csrf_token()}}">--}}

                {{-- Id input --}}
                <input type="text" style="display: none;" class="form-control" value="{{$offer -> id}}" name="offer_id">

                <td><img  style="width: 100px; height: 100px;" src="{{asset('images/offers/'.$offer->photo)}}"></td>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Enter a photo</label>
                    <input type="file" class="form-control" name="photo" placeholder="Enter a photo">
                    @error('photo')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Offer name</label>
                    <input type="text" class="form-control" name="name" placeholder="name" value='{{$offer->name}}'>
                    @error('name')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Offer price</label>
                    <input type="text" class="form-control" name="price" placeholder="price" value='{{$offer->price}}'>
                    @error('price')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Offer detailes</label>
                    <input type="text" class="form-control" name="detailes" placeholder="detailes" value='{{$offer->detailes}}'>
                    @error('detailes')
                    <small class="form-text text-danger">{{$message}}</small>
                    @enderror
                </div>
                <a  offer_id="{{$offer->id}}" id="update_offer" class="btn btn-primary">Update</a>
            </form>

        </div>
    </div>
@stop

@section('scripts')

    <script>
        $(document).on('click', '#update_offer', function (e) {
            e.preventDefault();


            var formData = new FormData($('#offerForm')[0]);
            var offer_id = $(this).attr('offer_id');



            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{route('ajax.offers.update')}}",
                data:formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data) {
                    if (data.status == true) {
                        $('#success_msg').show();
                    }

                },
                error: function (reject) {

                }
            });
        });
    </script>

@stop


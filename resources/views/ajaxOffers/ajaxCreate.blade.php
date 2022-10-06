@extends('layouts.create')

@section('content')

<div class="flex-center position-ref full-height">



    <div class="content">

        <div class="title m-b-md">
            Add your offer
        </div>


        <div class="alert alert-success" id="success_msg" style="display:none">
            Saved Successfully
        </div>


        @if(Session::has('success'))
        <div class="alert alert-primary" role="alert">
            {{Session::get('success')}}
        </div>
        @endif

        <form method="POST" id="offerForm" action="{{route('Offers.store')}}" enctype="multipart/form-data">

            @csrf
            {{--<input name = "_token" value = "{{csrf_token()}}">--}}

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Enter a photo</label>
                <input type="file" class="form-control" name="photo" placeholder="Enter a photo">
                @error('photo')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Offer name</label>
                <input type="text" class="form-control" name="name" placeholder="name">
                @error('name')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Offer price</label>
                <input type="text" class="form-control" name="price" placeholder="price">
                @error('price')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Offer detailes</label>
                <input type="text" class="form-control" name="detailes" placeholder="detailes">
                @error('detailes')
                <small class="form-text text-danger">{{$message}}</small>
                @enderror
            </div>
            <button id="save_offer" class="btn btn-primary">Save Offer</button>
        </form>

        @stop

        @section('scripts')

        <script>
            $(document).on('click', '#save_offer', function(e) {
                e.preventDefault();

                var formData = new FormData($('#offerForm')[0]);

                $.ajax({
                    type: 'post',
                    enctype: 'multipart/form-data',
                    url: "{{route('ajax.offers.store')}}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(data) {
                        if (data.status == true){
                            $('#success_msg').show();
                        }

                    },
                    error: function(reject) {

                    }
                });
            });
        </script>
        @stop

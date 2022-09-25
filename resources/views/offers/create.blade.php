<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        html,
        body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links>a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
    </style>
</head>

<body>
    <div class="flex-center position-ref full-height">
        <div class="content">
            <div class="title m-b-md">
                Add your offer
            </div>

            <form method="POST" action="{{route('Offers.store')}}">

                @csrf
                {{--<input name = "_token" value = "{{csrf_token()}}">--}}

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Offer name</label>
                    <input type="text" class="form-control" name="name" placeholder="name">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Offer price</label>
                    <input type="text" class="form-control" name="price" placeholder="price">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Offer detailes</label>
                    <input type="text" class="form-control" name="detailes" placeholder="detailes">
                </div>
                <button type="submit" class="btn btn-primary">Save Offer</button>
            </form>

        </div>
    </div>
</body>

</html>
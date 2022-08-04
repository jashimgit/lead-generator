<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $program->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        p {
            margin-bottom: 5px;
        }

        ;
    </style>
</head>

<body style="background-color: #e2e4e0  !important;">
    <div class="container">
        <div class="row ">
            <div class="col-sm-6  mx-auto mt-3">

                <div class="card ">

                    <div class="card-body">
                        <h5 class="card-title text-center">{{ $program->title }}</h5>
                        <h6 class="text-center">{{ $program->subtitle}}</h6>
                        <div>

                            {!! $program->details !!}
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                     @if(session('message')) 
                     <div class="alert alert-danger mt-2 mb-2" role="alert">
                            {{ session('message') }}
                    </div>
                     @endif
                        <form method="POST" action="{{ url('/register'.'/'.$program->slug) }}">
                            @csrf
                            <input type="hidden" name="program_id" value="{{ $program->id }}">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Full Name *</label>
                                <input type="text" class="form-control" name="name">

                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email *</label>
                                <input type="text" class="form-control" name="email">

                            </div>
                            <div class="mb-3">
                                <labelclass="form-label">Moblie Number *</label>
                                    <input type="text" class="form-control" name="phone">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>
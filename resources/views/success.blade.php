<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Success </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <style>
        p {
            margin-bottom: 5px;
            font-size: 26px;
        }

        ;
    </style>
</head>

<body style="background-color: #e2e4e0  !important;">
    <div class="container">
        <div class="row align-items-center " style="height: 100vh;">
            <div class="col-sm-6  mx-auto mt-3">

                <div class="card text-bg-success">

                    <div class="card-body" style="padding: 30px;">
                        <p class="card-title text-center"> Dear <b>{{ $registrationInfo->name }}</b>, You have been registered successfully in <b>{{ $registrationInfo->program->title }}</b> with <b>{{ $registrationInfo->email }} </b> and phone number is <b>{{ $registrationInfo->phone}}</b></p>

                    </div>
                </div>


            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>

</html>
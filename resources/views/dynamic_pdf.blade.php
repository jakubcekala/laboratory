<!DOCTYPE html>
<html>
<head>
    <title>Laravel - How to Generate Dynamic PDF from HTML using DomPDF</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style type="text/css">
        .box{
            width:600px;
            margin:0 auto;
        }
    </style>
</head>
<body>
<br />
<div class="container">
    <h3 align="center">Laboratory equipment report</h3><br/>

    <div class="row">
        <div class="col-md-7" align="right">
            <h4>Equpment data</h4>
        </div>
        <div class="col-md-5" align="right">
            <a href="{{ url('dynamic_pdf/pdf') }}" class="btn btn-danger">Convert into PDF</a>
        </div>
    </div>
    <br />
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Model</th>
                <th scope="col">Description</th>
                <th scope="col">Website</th>
                <th scope="col">Available</th>
                <th scope="col">All amount</th>
                <th scope="col">Image</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->model }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ $item->url }}</td>
                    <td>{{ $item->amount }}</td>
                    <td>{{ $item->all_amount }}</td>
                    <td>
                        <img src="items/fetch_image/{{ $item->id }}"  class="img-thumbnail" width="75" />
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

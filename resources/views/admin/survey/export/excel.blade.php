<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Export</title>
        <meta charset="UTF-8">
        <meta name=description content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet" media="screen"> -->
        <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"> -->
        <style>
            body {margin: 20px}
        </style>
    </head>
    <body>
        <table class="table table-bordered table-condensed">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Title</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
            @foreach($surveys as $survey)
                <tr>
                    <td>{{$survey->created_at}}</td>
                    <td>{{$survey->title}}</td>
                    <td>{{ str_limit($survey->description, 100) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </body>
</html>

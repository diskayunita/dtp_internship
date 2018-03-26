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
                    <th>#</th>
                    <th>Question Title</th>
                    <th>Answer</th>
                </tr>
            </thead>
            <tbody>
            @foreach($surveys->questions as $key => $question)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $question->title }}</td>
                            @php
                            $answers = ($surveys->global_type == 1) ? $question->public_answers->pluck('answer')->toArray() : $question->answers->pluck('answer')->toArray();
                            @endphp
                            <td>{{ implode(", ",$answers) }}</td>
                        </tr>
                    @endforeach
            </tbody>
        </table>
    </body>
</html>

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
        <th>Nama</th>
        <th>Contact</th>
        <th>Email </th>
        <th>University</th>
        <th>Faculty</th>
        <th>Remaining Credit</th>
        <th>Internship</th>
        <th>Status</th>
        <th>Location</th>
        <th>Job Area </th>       
    </tr>
    </thead>

    <tbody>
    @foreach($events as $key => $event)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $event->username }}</td>
            <td>{{ str_replace('+', '', $event->contact) }}</td>
            <td>{{ $event->email }}</td>
            <td>{{ $event->university }}</td>
            <td>{{ $event->faculty }}</td>
            <td>{{ $event->credits }}</td>
            <td>{{ $event->type }}</td>
            <td>{{ ucfirst($event->approval) }}</td>
            <td>{{ ucfirst($event->name_purpose) }}</td>
            <td>{{ ucfirst($event->name_product) }}</td>
            
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>

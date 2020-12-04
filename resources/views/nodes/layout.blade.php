<!DOCTYPE html>
<html>
<head>
    <title>Laravel 8 CRUD Application - ItSolutionStuff.com</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <script src="https://balkangraph.com/js/latest/OrgChart.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        html, body {
            width: 100%;
            height: 100%;
            padding: 0;
            margin: 0;
            overflow: hidden;
        }

        #tree {
            width: 100%;
            height: 100%;
        }

        .field_0 {
            font-family: Impact;
        }
    </style>
</head>
<body>
  
<div style="height: 100%">
    @yield('content')
</div>
   
</body>
</html>


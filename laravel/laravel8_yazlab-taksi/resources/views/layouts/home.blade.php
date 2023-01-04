<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="oguzhanse7en.com">
    <meta name="description" content="Website Demo">
    <meta name="keywords" content="HTML, CSS, jquery">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        @yield('title')
    </title>
    <!-- _____________________________ bootstrap-5.1.0 _____________________________________________________________ -->
    <link rel="stylesheet" type="text/css" href="{{asset('home')}}/assets/bootstrap-5.1.0/css/bootstrap.min.css">

    @show
</head>

<body>
@include('home.navbar')


@section('content')
</body>

<!-- _____________________________ jQuery _____________________________________________________________ -->
<script type="text/javascript" src="{{asset('home')}}/js/default/jquery-3.5.1.min.js"></script>

<!-- _____________________________ bootstrap-5.1.0 _____________________________________________________________ -->
<script type="text/javascript" src="{{asset('home')}}/assets/bootstrap-5.1.0/js/bootstrap.min.js"></script>

@show

</html>

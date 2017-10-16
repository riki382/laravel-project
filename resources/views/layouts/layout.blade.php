<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | E-Shopper</title>
    <link href="/front/css/bootstrap.min.css" rel="stylesheet">
    <link href="/front/css/font-awesome.min.css" rel="stylesheet">
    <link href="/front/css/prettyPhoto.css" rel="stylesheet">
    <link href="/front/css/price-range.css" rel="stylesheet">
    <link href="/front/css/animate.css" rel="stylesheet">
	<link href="/front/css/main.css" rel="stylesheet">
	<link href="/front/css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="/front/js/html5shiv.js"></script>
    <script src="/front/js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="/front/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/front/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/front/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/front/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/front/images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	@include('layouts.header')
	





	@yield('body_content')





	
	@include('layouts/footer')
	

  
    <script src="/front/js/jquery.js"></script>
	<script src="/front/js/bootstrap.min.js"></script>
	<script src="/front/js/jquery.scrollUp.min.js"></script>
	<script src="/front/js/price-range.js"></script>
    <script src="/front/js/jquery.prettyPhoto.js"></script>
    <script src="/front/js/main.js"></script>
</body>
</html>
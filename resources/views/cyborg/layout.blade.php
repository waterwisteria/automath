<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<title>@yield('title', 'Automath')</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="stylesheet" href="/cyborg/assets/css/fontawesome.css">
	<link rel="stylesheet" href="/cyborg/assets/css/templatemo-cyborg-gaming.css">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<link rel="stylesheet" href="/cyborg/assets/css/owl.css">
	<!-- link rel="stylesheet" href="/cyborg/assets/css/animate.css" -->
	<link rel="stylesheet" href="/cyborg/assets/css/custom.css">
	<!-- link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" -->
</head>
<body>

@yield('body')

<script src="/cyborg/vendor/jquery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="/cyborg/assets/js/owl-carousel.js"></script>
<script src="/cyborg/assets/js/custom.js"></script>
</body>
</html>
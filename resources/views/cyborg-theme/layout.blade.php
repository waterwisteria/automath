<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
	<title>@yield('title', 'Cyborg - Awesome HTML5 Template')</title>
	<link href="/cyborg/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/cyborg/assets/css/fontawesome.css">
	<link rel="stylesheet" href="/cyborg/assets/css/templatemo-cyborg-gaming.css">
	<link rel="stylesheet" href="/cyborg/assets/css/owl.css">
	<link rel="stylesheet" href="/cyborg/assets/css/animate.css">
	<link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css">
</head>
<body>

@yield('body')

<!-- Scripts -->
<!-- Bootstrap core JavaScript -->
<script src="/cyborg/vendor/jquery/jquery.min.js"></script>
<script src="/cyborg/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="/cyborg/assets/js/isotope.min.js"></script>
<script src="/cyborg/assets/js/owl-carousel.js"></script>
<script src="/cyborg/assets/js/tabs.js"></script>
<script src="/cyborg/assets/js/popup.js"></script>
<script src="/cyborg/assets/js/custom.js"></script>
</body>
</html>
<!DOCTYPE html>
<head>

<!-- Basic Page Needs
================================================== -->
<title>{{ env('APP_NAME') }}</title>
<meta charset="utf-8">
<!-- Become a digital invoicer today -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="title" content="{{ env('APP_NAME') }} - Emite comprobantes sin contratos">
<meta name="description" content="{{ env('APP_NAME') }} es una plataforma que te ayuda a emitir comprobantes electrónicos, gestionar tu stock y mantener una base de datos de clientes. Todo en línea. Aprovecha nuestros planes desde S/ 50.00 al mes.">
<meta name="keywords" content="facturacion electronica, peru, factura, sunat, digital invoice, digital invoices, entreprenour, developer, software, freelance">
<meta name="robots" content="index, follow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="language" content="Spanish">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/main_color.css" id="colors">
<link rel="icon" type="image/png" href="img/logo.png">

</head>

<body class="transparent-header">

<!-- Wrapper -->
<div id="wrapper">
<!-- Header Container
================================================== -->
<header id="header-container">

    <!-- Header -->
	<div id="header">
		<div class="container">
			
			<!-- Left Side Content -->
			<div class="left-side">
				
				<!-- Logo -->
				<div id="logo">
                    <a href="/" style="color: #ffffff;">
                        <img src="img/logo.png" data-sticky-logo="img/logo.png" alt="">
                        {{ env('APP_NAME') }}
                    </a>
				</div>

				<!-- Mobile Navigation -->
				<div class="mmenu-trigger">
					<button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</div>

				<!-- Main Navigation -->
				<nav id="navigation" class="style-1">
					<ul id="responsive">
						<li><a href="/contact-us">Contáctanos</a></li>
						<li><a href="/faq">Preguntas</a></li>
						<li><a href="/forum">Foro</a></li>
						<li><a href="/countries">Países</a></li>
					</ul>
				</nav>
				<div class="clearfix"></div>
				<!-- Main Navigation / End -->
				
			</div>
			<!-- Left Side Content / End -->


			<!-- Right Side Content / End -->
			<div class="right-side">
				<div class="header-widget">
					<a href="/login" class="button border with-icon">Ingresar</a>
				</div>
			</div>
			<!-- Right Side Content / End -->
		</div>
	</div>
	<!-- Header / End -->

</header>
<!-- Header Container
================================================== -->
<div class="clearfix"></div>
<!-- Header Container / End -->
<!-- Banner
================================================== -->
<div class="main-search-container dark-overlay">
	<div class="main-search-inner">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h2>.</h2>
					<h4>.</h4>

                    <form action="/send-mailing" method="GET" class="form-control" style="width:100%;">
                        <div class="main-search-input">
                            <div class="main-search-input-item">
                                <input type="email" id="email" name="email" placeholder="Ingresa tu correo electrónico y nos pondremos en contacto contigo" value=""/>
                            </div>
                            <button class="button">Unirme a {{ env('APP_NAME') }}</button>
                        </div>
                    </form>
                    <br>
                    <div class="col-md-12" align="center">
                        <h5 style="color: #ffffff;">© 2020 {{ env('APP_NAME') }}. Todos los derechos reservados.</h5>
                    </div>	
				</div>
			</div>
		</div>
	</div>
	<!-- Video -->
	<div class="video-container">
		<video poster="img/main-search-video-poster.jpg" loop autoplay muted>
			<source src="img/main-search-video.mp4" type="video/mp4">
		</video>
	</div>
</div>

<!-- Footer / End -->

<!-- Scripts
================================================== -->
<script type="text/javascript" src="scripts/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="scripts/jquery-migrate-3.1.0.min.js"></script>
<script type="text/javascript" src="scripts/mmenu.min.js"></script>
<script type="text/javascript" src="scripts/chosen.min.js"></script>
<script type="text/javascript" src="scripts/slick.min.js"></script>
<script type="text/javascript" src="scripts/rangeslider.min.js"></script>
<script type="text/javascript" src="scripts/magnific-popup.min.js"></script>
<script type="text/javascript" src="scripts/waypoints.min.js"></script>
<script type="text/javascript" src="scripts/counterup.min.js"></script>
<script type="text/javascript" src="scripts/jquery-ui.min.js"></script>
<script type="text/javascript" src="scripts/tooltips.min.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.head')
</head>
<body class="animsition">

	<!-- Header -->
	<header>
        @include('home.header')
	</header>

    @include('home.cart')


    @yield('contents')


    @include('home.footer')

</body>
</html>

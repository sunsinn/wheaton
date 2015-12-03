<!doctype html>
<html>
<head>
    <title>
        @yield('title','WhEatOn')
    </title>

    <meta charset='utf-8'>




    {{-- Yield any page specific CSS files or anything else you might want in the <head> --}}
    @yield('head')
    <link href='https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/journal/bootstrap.min.css' rel='stylesheet'>
</head>
<body>

    @if(\Session::has('flash_message'))
        <div class='flash_message'>
            {{ \Session::get('flash_message') }}
        </div>
    @endif

    <header>

    </header>

    <nav>
            @if(Auth::check())
                <a href='/'>Home</a> +
                <a href='/search'>Find a recipe</a> +
                <a href='/add'>Add a new recipe</a> +
                <a href='/logout'>Log out</a>
            @else
                <a href='/'>Home</a> +
                <a href='/search'>Find a recipe</a> +
                <a href='/login'>Log in</a> +
                <a href='/register'>Register</a>
            @endif
    </nav>

    <section>
        {{-- Main page content will be yielded here --}}
        @yield('content')
    </section>


    @yield('body')

</body>
</html>

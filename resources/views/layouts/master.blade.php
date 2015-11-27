<!doctype html>
<html>
<head>
    <title>
        @yield('title','WhEatOn')
    </title>

    <meta charset='utf-8'>




    {{-- Yield any page specific CSS files or anything else you might want in the <head> --}}
    @yield('head')

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
        <ul>
            @if(Auth::check())
                <li><a href='/'>Home</a></li>
                <li><a href='/search'>Find a recipe</a></li>
                <li><a href='/add'>Add a new recipe</a></li>
                <li><a href='/logout'>Log out</a></li>
            @else
                <li><a href='/'>Home</a></li>
                <li><a href='/search'>Find a recipe</a></li>
                <li><a href='/login'>Log in</a></li>
                <li><a href='/register'>Register</a></li>
            @endif
        </ul>
    </nav>

    <section>
        {{-- Main page content will be yielded here --}}
        @yield('content')
    </section>


    @yield('body')

</body>
</html>

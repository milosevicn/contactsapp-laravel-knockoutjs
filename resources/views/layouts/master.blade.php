<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{isset($page_title) ? "$page_title | " : ''}} Contacts App</title>
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>

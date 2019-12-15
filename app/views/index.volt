<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        {{ get_title() }}
        {{ stylesheet_link('/css/style.css') }}
        {{ stylesheet_link('https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css') }}
        {{ stylesheet_link('https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css') }}
        {{ assets.outputCss() }}
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Test Task">
        <meta name="author" content="MG">
    </head>
    <body>
        <div class="container">
            {{ content() }}
            {{ javascript_include('https://code.jquery.com/jquery-3.3.1.slim.min.js') }}
            {{ javascript_include('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js') }}
            {{ assets.outputJs() }}
        </div>
    </body>
</html>

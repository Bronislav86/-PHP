<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ title }}</title>
        <link rel="stylesheet" href="/styles/style.scss" />
    </head>
    <body>
    {% include 'layouts/site-header.tpl' %}
        <nav class="navigation">
            <a class="navigation__a" href='/'>Главная</a>
            <a class="navigation__a" href='/user'>Пользователи</a>
            <a class="navigation__a" href='/site/info'>Информация</a>
        </nav>
    {% include content_template_name %}
    {% include 'layouts/site-footer.tpl' %}
    </body>
</html> 
<!DOCTYPE HTML >
<html>
    <head>
        <title>FormBuilder</title>
        {{ HTML::style('css/style.css') }}
        {{ HTML::script('js/jquery-1.8.0.js') }}
    </head>
    <body>
        <div class="header">
            <h1 style="text-align: center;margin-top: 0px;">FormBuilder</h1>
        </div>
            <div class="nav">
                <ul class="nav_list">
                    <li>{{ HTML::link_to_action("Home@index",'Home')}}</li>
                    <li>{{ HTML::link_to_action("Home@forms",'Manage Forms')}}</li>
                </ul>
            </div>
        <div class="main_content" style="">
            @yield('content')
            <div class="clear-fix"></div>
        </div>
    </body>
</html>
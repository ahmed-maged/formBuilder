<!DOCTYPE HTML >
<html>
    <head>
        <title>FormBuilder</title>
        <link rel="stylesheet" href="public/css/style.css">
        <script src="public/js/jquery-1.8.3.js"></script>
    </head>
    <body>
        <div class="header">
            <h1 style="text-align: center;margin-top: 0px;">FormBuilder</h1>
        </div>
            <div class="nav">
                <ul class="nav_list">
                    <li><a href="<?php echo $this->baseUrl ?>/index">Index</a></li>
                    <li><a href="<?php echo $this->baseUrl ?>/manage_forms">Manage forms</a></li>
                </ul>
            </div>
        <div class="main_content" style="">
            <?php echo $content ?>
            <div class="clear-fix"></div>
        </div>
    </body>
</html>
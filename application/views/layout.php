<html>
    <head>
        <title> Hello *.* </title>
    </head>
    <body>
        <div id="menu">
            <li><a href="#">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="#">Contact</a></li>
        </div>

        <div id="main-content">
            <?php $this->load->view($content); ?>
        </div>

        <div id="footer">
            LambdaDev Hello World
        </div>
    </body>
</html>

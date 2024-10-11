<html>
    <head>
        <title>MyFirst Php Page</title>
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                background-color: #f4f4f4;
                color: #333;
                text-align: center;
                margin-top: 50px;            }
        </style>
    </head>
    <body>
        <!-- adding php to the body -->
         <?php
            $name = "Russel Wilson";           
         ?>
         <p> Hi! My name is <?php echo $name ?>, and I am the new Steelers starting QB for 2024 </p> 
    </body>
</html>
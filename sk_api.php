<?php
require 'connect.php';
require 'header.php';




?>


<!DOCTYPE html>

<html lang="en">

    <head>
        <script src="api_script.js"></script>

        <link rel="stylesheet" href="skate_style.css" />

        <meta charset="UTF-8" />

        <meta name="viewport"

              content="width=device-width, initial-scale=1.0" />

        <title>Document</title>

    </head>

    <body>


      <header>
        <h1 class="title">Winnipeg City Skateparks</h1>
      </header>





        <!--   <! Here a loader is created which
             loads till response comes -->

        <div class="d-flex justify-content-center">

            <div class="spinner-border"

                 role="status" id="loading">

                <span class="sr-only">Loading...</span>

            </div>
            <p> Park data provided by the <a href="https://data.winnipeg.ca/">City of Winnipeg Open Data catalogue</a>.
            </p>
        </div>

        <!-- table for showing data -->

        <table id="location_description"></table>

    </body>

</html>












<!-- Footer inserted here -->
<br /><br />
<?php  require 'footer.php'; ?>

<?php ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Bootswatch: Cerulean</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <link rel="stylesheet" href="https://bootswatch.com/cerulean/bootstrap.min.css" media="screen">
  <link rel="stylesheet" href="../assets/css/custom.min.css">
  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../bower_components/html5shiv/dist/html5shiv.js"></script>
      <script src="../bower_components/respond/dest/respond.min.js"></script>
      <![endif]-->
    </head>
    <body>
      <div class="container">
        <?php
        require_once 'includes/functions.php';
        $item = array ('name'=>'vic','age'=>'12');
        $book = R::dispense ('book');
        $book->import( $item );
        R::store($book);


        ?>

      </div>


      <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
      <script src="https://bootswatch.com/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="../assets/js/custom.js"></script>
    </body>
    </html>

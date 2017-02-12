<?php
require_once 'includes/functions.php';

function site_header() {
  global $app;
  ?>
  <!DOCTYPE html>
  <html lang='en'>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $app['name']; ?></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap Cerulean Theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cerulean/bootstrap.min.css" />
        <!-- Bootstrap Origianl Theme
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />  -->
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="css/bs3-template.css">
      </head>
      <?php
} // end of function site_header() 

function body_header($class = '', $menu = 1) {
  global $app;
  ?>
  <body class='<?php echo $class; ?>'>
    <?php 
    if ($menu) {
      ?>

      <div class="navbar navbar-default">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $app['url']; ?>"><?php echo $app['name']; ?></a>
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li><a href="logout.php">Logout</a></li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div><!-- end of navbar-default -->
      <?php  
    }
    ?>
    <div class="container">
      <?php
        } // end of function body_header()

        function body_footer(){
          ?>
        </div> <!-- end of div container -->
    <!-- 
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" ></script> 
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
  -->
  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="https://bootswatch.com/bower_components/bootstrap/dist/js/bootstrap.min.js" ></script>
</body>
<?php
} // end of function body_footer()

function site_footer(){
  ?>
  </html>
  <?php
}// end of function site_footer()
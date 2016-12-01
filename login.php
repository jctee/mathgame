<?php

session_start();
if(isset($_SESSION['login']) && $_SESSION['login'] == 'yes') {
	header('Location: index.php');
}

?>
<!DOCTYPE html>
<html>
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <title>Math Game</title>
      <link href="style/bootstrap.css" rel="stylesheet" media="screen">
   </head>
   <body>

      <div class="container">

         <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
               <h1>Please login to enjoy our math game.</h1>
            </div>
            <div class="col-sm-1"></div>
         </div>

         <form action="authenticate.php" method="post" role="form" class="form-horizontal">

						<div class="form-group">
               <div class="col-sm-4 text-right">Email:</div>
               <div class="col-sm-3">
                  <input type="text" class="form-control" id="email" name="email" placeholder="Email" size="6">
               </div>
               <div class="col-sm-5"></div>
            </div>

            <div class="form-group">
               <div class="col-sm-4 text-right">Password:</div>
               <div class="col-sm-3">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Password" size="6">
               </div>
               <div class="col-sm-5"></div>
            </div>

            <div class="row">
               <div class="col-sm-3 col-sm-offset-4">
                  <button type="submit" class="btn btn-primary">Login</button>
               </div>
            </div>

         </form>

         <div class="row">

					 <?php
					 if(isset($_GET['msg'])) {
						 $msg = $_GET['msg'];
						 urldecode($msg);
						 echo '<p class="col-sm-3 col-sm-offset-4 text-danger">' . $msg . '</p>';
					 }
					 ?>

				 </div>
      </div>

    </body>
</html>

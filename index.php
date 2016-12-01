<?php

// Check if logged in
session_start();
if(empty($_SESSION['login'])) {
	header('Location: login.php');
}

$correct = NULL;
$score = NULL;
$total = NULL;
$error = NULL;

if($_SERVER['REQUEST_METHOD'] == 'POST') {

	// Grab hidden form data
  $lastFirstNum = $_POST['firstNum'];
  $lastSecondNum = $_POST['secondNum'];
  $lastOperation = $_POST['operation'];
  $lastScore = $_POST['score'];
  $lastTotal = $_POST['total'] + 1;

	// If answer is numeric
  if (is_numeric($_POST['answer'])) {

		// Calculate Answer
    if($lastOperation == '+') {
      $answer = $lastFirstNum + $lastSecondNum;
    } else {
      $answer = $lastFirstNum - $lastSecondNum;
    }

		// Check if guess was correct
    if($_POST['answer'] == $answer) {
      $correct = 1;
      $lastScore++;
    } else {
      $correct = 2;
    }

  } else {
    $error = true;
  }

  $score = $lastScore;
  $total = $lastTotal;

} else {
  $score = 0;
  $total = 0;
}

// Generate random questions
$holder = rand(1, 2);
$firstNum = rand(0, 20);
$secondNum = rand(0, 20);

if($holder == 1) {
  $operation = '+'; // Set Operator as addition
}
else {
  $operation = '-'; // Set Operator as subtraction
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
         <form action="index.php" method="post" role="form" class="form-horizontal">
            <div class="row">
               <div class="col-sm-4 col-sm-offset-4">
                  <h1>Math Game</h1>
               </div>
               <div class="col-sm-4"><a href="logout.php" class="btn btn-default btn-sm">Logout</a></div>
            </div>
            <div class="row">
               <label class="col-sm-2 col-sm-offset-3"><?php echo $firstNum; ?></label>
               <label class="col-sm-2"><?php echo $operation; ?></label>
               <label class="col-sm-2"><?php echo $secondNum; ?></label>
               <div class="col-sm-3"></div>
            </div>

            <input type="hidden" name="firstNum" value="<?php echo $firstNum; ?>">
            <input type="hidden" name="operation" value="<?php echo $operation; ?>">
            <input type="hidden" name="secondNum" value="<?php echo $secondNum; ?>">
            <input type="hidden" name="total" value="<?php echo $total; ?>">
            <input type="hidden" name="score" value="<?php echo $score; ?>">

            <div class="form-group">
               <div class="col-sm-3 col-sm-offset-4">
                  <input type="text" class="form-control" id="answer" name="answer" placeholder="Enter answer" size="6">
               </div>
               <div class="col-sm-5"></div>
            </div>
            <div class="row">
               <div class="col-sm-3 col-sm-offset-4">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <button type="submit" class="btn btn-primary btn-sm">
                  Submit</button>
               </div>
               <div class="col-sm-3"></div>
            </div>
         </form>
         <hr>
         <div class="row">
            <div class="col-sm-4 col-sm-offset-4">
              <?php

              if($correct == 1) {
                echo '<span style="color: green; font-weight: bold;">Correct</span>';
              } else if($correct == 2) {
                echo '<span style="color: red; font-weight: bold;">INCORRECT, ' . $lastFirstNum . ' ' . $lastOperation . ' ' . $lastSecondNum . ' is ' . $answer . '.</span>';
              } else if ($error) {
                echo '<span style="color: red; font-weight: bold;">You must enter a number for your answer.</span>';
              }

              ?>
            </div>
            <div class="col-sm-4"></div>
         </div>
         <div class="row">
            <div class="col-sm-4 col-sm-offset-4">

              <?php
              if ($total !== 0) {
                echo 'Score: ' . $score . ' / ' . $total;
              } else {
                echo 'Score: 0 / 0';
              }
              ?>

            </div>
            <div class="col-sm-4"></div>
         </div>
      </div>
    </body>
</html>

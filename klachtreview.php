<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<?php
    include "./nav.php";
    ?>
   <section class="reviewpage">
    <section class="reviewtxtback">
    <h1 class= "klachth1">Klacht</h1>
    
    <?php 
session_start();

    echo  '<p class="reviewnaam">naam: </p>'; 
    echo  '<p class="textreview">'. $_POST["naam"] . '</p>';
    echo "<br>";
    echo "<br>";
    echo '<p class="reviewemail">email: </p>';
    echo  '<p class="textreview">'. $_POST["email"] . '</p>';
    echo "<br>";
    echo "<br>";
    echo '<p class="reviewklacht">klacht: </p>';
    echo  '<p class="textreview">'. $_POST["klacht"] . '</p>';
?>
   </section>
  </section>
<?php
    include "./footer.php";
    ?>  
</body>
</html>
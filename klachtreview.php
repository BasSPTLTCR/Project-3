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
<!-- <form action="" method="post">
                <label for="naam" >Naam:</label>
                <input type="text" name="naam">
                <br>
                <label for="email">Email:</label>
                <input type="email" name="email" require>
                <br>
                <br>
                <textarea name="klacht" cols="50" rows="15"></textarea>
                <br>
                <input type="submit" value="Verstuur" class="klachtbtn">
        </form> -->
   </section>
  </section>
<?php
    include "./footer.php";
    ?>  
</body>
</html>
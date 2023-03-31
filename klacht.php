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
    <main>
      <section class="klachtpage">
        <section class="klachttxtback">
        <form action="klachtreview.php" method="post">
        <h1 class= "klachth1">Klacht</h1>
            <form action="./klachtreview.php" method="post">
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
        </form>
        </section>
      </section>
    </main>
    <?php
    include "./footer.php";
    ?>    
</body>
</html>
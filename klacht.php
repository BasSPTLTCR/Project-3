<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klachten Formulier</title>
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
        <h1 class= "klachth1">Klachten Formulier</h1>
        <!-- form klachten -->
            <form action="./klachtreview.php" method="post">
                <label for="naam" >Naam:</label>
                <input type="text" name="naam" required>
                <br>
                <label for="email">Email:</label>
                <input type="email" name="email" required>
                <br>
                <div class="klantrdiv">
                <div>
                <input type="radio" name="klachtr" value="product"><label for="product">product</label>
                </div>
                <div>
                <input type="radio" name="klachtr" value="werknemer"><label for="werknemer">werknemer</label>
                </div>
                <div>
                <input type="radio" name="klachtr" value="website"><label for="website">website</label>
                </div>
                </div>
                <br>
                <label for="com">Klacht: </label>
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
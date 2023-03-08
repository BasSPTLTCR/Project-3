<!--Pagina van Pascal-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php
    include "./nav.php";
    ?>
    <div class="form-img">
        <section class="form post">
            <?php
            echo "Compliment";
            echo "<br>";
            echo "<br>";
            echo "Naam: " . $_POST['name'];
            echo "<br>";
            echo "<br>";
            echo "E-Mail: " . $_POST['email'];
            echo "<br>";
            echo "<br>";
            echo "Compliment: " . $_POST['com'];
            ?>
        </section>
        <form action="./index.php" method="post">
            <input type="submit" value="Confirm">
        </form>
    </div>
    <?php
    include "./footer.php";
    ?>
</body>
</html>
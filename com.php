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
        <section class="form">
            <h1>Complimenten Formulier</h1>
            <form action="" method="post">
                <label for="name">Naam: </label>
                <input type="text" name="name">
                <br>
                <label for="email">E-Mail: </label>
                <input type="email" name="email">
                <br>
                <label for="com">Compliment: </label>
                <br>
                <textarea name="com" cols="30" rows="10"></textarea>
                <br>
                <input type="submit" value="Verstuur" class="button">
            </form>
        </section>
    </div>
    <?php
    include "./footer.php";
    ?>
</body>
</html>
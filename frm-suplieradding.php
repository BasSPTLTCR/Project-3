<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>toevoegen brouwer</title>
</head>
<body>
    <h2>Geef de gegevens van de brouwer op</h2>
    <form action="./chk-insertbrewer.php" method="post">
        <input type="text" name="name" required>
        <input type="text" name="address" required>
        <input type="text" name="country" required>
        <input type="text" name="Phonenr" required>
        <input type="email" name="Email" required>
        <input type="submit" value="voegtoe" name="voegtoe">
    </form>
</body>
</html>
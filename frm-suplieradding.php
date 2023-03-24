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
        <input type="text" name="supname" required>
        <input type="text" name="supaddress" required>
        <input type="text" name="supcountry" required>
        <input type="text" name="supPhonenr" required>
        <input type="email" name="supEmail" required>
        <input type="submit" value="voegtoe" name="voegtoe">
    </form>
</body>
</html>
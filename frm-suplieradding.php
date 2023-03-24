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
    <form action="./chk-suplieradding.php" method="post">
        <label for="supname">Leveranciernaam</label>
        <input type="text" name="supname" required>
        <label for="supname">LeverancierAderes</label>
        <input type="text" name="supaddress" required>
        <label for="supname">LeverancierLand</label>
        <input type="text" name="supcountry" required>
        <label for="supname">LeverancierTelefoon</label>
        <input type="text" name="supPhonenr" required>
        <label for="supname">Leverancieremail</label>
        <input type="email" name="supEmail" required>
        <input type="submit" value="voegtoe" name="voegtoe">
    </form>
</body>
</html>
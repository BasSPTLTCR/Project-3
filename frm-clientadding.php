<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>toevoegen klant</title>
</head>
<body>
<?php
    include "./nav.php";
    ?>
    <?php
        #1 verbinding database
        require './dbconnenct.php';

        #2 querydef
        try
        {
            $fullQuery = $db->prepare("SELECT client.`firstname` AS clientfirstname FROM `client` ORDER BY `firstname` ASC;");
            $fullQuery = $db->prepare("SELECT client.`surname` AS clientsurname FROM `client` ORDER BY `surname` ASC;");
            $fullQuery = $db->prepare("SELECT client.`gender` AS clientgender FROM `client` ORDER BY `gender` ASC;");
            $fullQuery = $db->prepare("SELECT client.`address` AS clientaddress FROM `client` ORDER BY `address` ASC;");
            $fullQuery = $db->prepare("SELECT client.`city` AS clientcity FROM `client` ORDER BY `city` ASC;");
            $fullQuery = $db->prepare("SELECT client.`zipcode` AS clientzipcode FROM `client` ORDER BY `zipcode` ASC;");
            $fullQuery = $db->prepare("SELECT client.`email` AS clientemail FROM `client` ORDER BY `email` ASC;");
            $fullQuery = $db->prepare("SELECT client.`phonenumber` AS clientphonenumber FROM `client` ORDER BY `phonenumber` ASC;");
            $fullQuery = $db->prepare("SELECT client.`username` AS clientusername FROM `client` ORDER BY `username` ASC;");
            $fullQuery = $db->prepare("SELECT client.`password` AS clientpassword FROM `client` ORDER BY `password` ASC;");
           
        }
        catch(PDOException $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        #3 querydoen
        $fullQuery->execute();
        

        #4 checkresult
        if ($fullQuery->RowCount() > 0)
        {
        $result=$fullQuery->FetchAll(PDO::FETCH_ASSOC);
        
?>
    <h2>Geef de gegevens van de klant op</h2>
    <form action="./chk-clientadding.php" method="post">
        <label for="clientfirstname">Klant voornaam</label>
        <input type="text" name="clientfirstname" required>

        <label for="clientsurname">Klant achternaam</label>
        <input type="text" name="clientsurname" required>

        <label for="clientgender">Klant geslacht</label>
        <input type="text" name="clientgender" required>

        <label for="clientaddress">Klant adres</label>
        <input type="text" name="clientaddress" required>

        <label for="clientcity">Klant stad</label>
        <input type="text" name="clientcity" required>

        <label for="clientzipcode">Klant zipcode</label>
        <input type="text" name="clientzipcode" required>

        <label for="clientemail">Klant email</label>
        <input type="text" name="clientemail" required>

        <label for="clientphonenumber">Klant telefoonnummer</label>
        <input type="text" name="clientphonenumber" required>

        <label for="clientusername">Klant gebruikersnaam</label>
        <input type="text" name="clientusername" required>

        <label for="clientpassword">Klant wachtwoord</label>
        <input type="text" name="clientpassword" required>

        <input type="submit" value="voegtoe" name="voegtoe">
    </form>
    <?php
        }
    ?>
    <?php
    include "./footer.php";
    ?>
</body>
</html>
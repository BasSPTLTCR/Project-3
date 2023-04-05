<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Klanten toevoegen</title>
</head>
<body>
<?php
    include "./nav.php";
    ?>
<?php
    if (isset($_POST["annul"])) {
        echo "<h2>Niet toevoegen</h2>";
        header("Refresh:3; url=frm-clientadding.php");
        die;
    }
    if (!isset($_POST["confirm"])) {
        echo "<h2>Niet juist hier gekomen</h2>";
        header("Refresh:3; url=frm-clientadding.php");
        die;
    }
    if (! isset($_POST["clientfirstname"]) || ! isset($_POST["clientsurname"]) || ! isset($_POST["clientgender"]) ||
        ! isset($_POST["clientaddress"]) || ! isset($_POST["clientcity"]) || ! isset($_POST["clientzipcode"]) || 
        ! isset($_POST["clientemail"]) || ! isset($_POST["clientphonenumber"]) || ! isset($_POST["clientusername"]) || ! isset($_POST["clientpassword"]) ) {
        echo "<h2>gegevens verloren, contact beheer</h2>";
        header("Refresh:3; url=frm-clientadding.php");
        die;
    }
    require './dbconnenct.php';
    $clientfirstname = $_POST["clientfirstname"];
    $clientsurname = $_POST["clientsurname"];
    $clientgender = $_POST["clientgender"];
    $clientaddress = $_POST["clientaddress"];
    $clientcity = $_POST["clientcity"];
    $clientzipcode = $_POST["clientzipcode"];
    $clientemail = $_POST["clientemail"];
    $clientphonenumber = $_POST["clientphonenumber"];
    $clientusername = $_POST["clientusername"];
    $clientpassword = $_POST["clientpassword"];
    #maak hieronder de insert qry
    echo $clientfirstname;
    echo "<br>";
    echo $clientsurname;
    echo "<br>";
    echo $clientgender;
    echo "<br>";
    echo $clientaddress;
    echo "<br>";
    echo $clientcity;
    echo "<br>";
    echo $clientzipcode;
    echo "<br>";
    echo $clientemail;
    echo "<br>";
    echo $clientphonenumber;
    echo "<br>";
    echo $clientusername;
    echo "<br>";
    echo $clientpassword;
    echo "<br>";
    $insquery = $db->prepare("INSERT INTO client (firstname, surname, gender, address, city, zipcode, email, phonenumber, username, password) 
                                VALUES (:clientfirstname, :clientsurname, :clientgender, :clientaddress, :clientcity, :clientzipcode, :clientemail, :clientphonenumber, :clientusername, :clientpassword)"); 
    $insquery->bindValue("clientfirstname", $clientfirstname);
    $insquery->bindValue("clientsurname", $clientsurname);
    $insquery->bindValue("clientgender", $clientgender);
    $insquery->bindValue("clientaddress", $clientaddress);
    $insquery->bindValue("clientcity", $clientcity);
    $insquery->bindValue("clientzipcode", $clientzipcode);
    $insquery->bindValue("clientemail", $clientemail);
    $insquery->bindValue("clientphonenumber", $clientphonenumber);
    $insquery->bindValue("clientusername", $clientusername);
    $insquery->bindValue("clientpassword", $clientpassword);
            $insquery   ->execute();
    ?>
    <?php
    include "./footer.php";
    ?>
</body>
</html>
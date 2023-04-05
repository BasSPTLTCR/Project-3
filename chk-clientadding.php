<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>verificatie klant</title>
</head>
<body>
<?php
    include "./nav.php";
    ?>
    <?php
    

    function test_input($datatest) {
        $datatest = ltrim($datatest);
        $datatest = rtrim($datatest);
        $datatest = stripslashes($datatest);
        $datatest = htmlspecialchars($datatest);
        return $datatest;
    }
    #0a komt via frm?
    if (! isset($_POST["voegtoe"])) {
        echo "<h2>niet juiste manier</h2>";
        header("Refresh:3; url=frm-clientadding.php");
    }
    else {
        require './dbconnenct.php';
        $clientfirstname = test_input($_POST["clientfirstname"]);
        $clientsurname = test_input($_POST["clientsurname"]);
        $clientgender = test_input($_POST["clientgender"]);
        $clientaddress = test_input($_POST["clientaddress"]);
        $clientcity = test_input($_POST["clientcity"]);
        $clientzipcode = test_input($_POST["clientzipcode"]);
        $clientemail = test_input($_POST["clientemail"]);
        $clientphonenumber = test_input($_POST["clientphonenumber"]);
        $clientusername = test_input($_POST["clientusername"]);
        $clientpassword = test_input($_POST["clientpassword"]);
        #0b vraag gegeven voor voegtoe

        #1 control gegevens
        #1-1 komt id voor?
        try
        {
            $chkclientfirstname = $db->prepare("SELECT `firstname` FROM `client` WHERE `firstname` = :clientfirstname");
            $chkclientfirstname->bindValue(':clientfirstname', $clientfirstname);
        }
        catch(PDOException $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkclientfirstname->RowCount() < 0) {
            echo "Klant voornaam bestaal al";
        }
        try
        {
            $chkclientsurname = $db->prepare("SELECT `surname` FROM `client` WHERE `surname` = :clientsurname");
            $chkclientsurname->bindValue(':clientsurname', $clientsurname);
        }
        catch(PDOException $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkclientsurname->RowCount() < 0) {
            echo "Klant achternaam bestaat al";
        }

        try
        {
            $chkclientgender = $db->prepare("SELECT `gender` FROM `client` WHERE `gender` = :clientgender");
            $chkclientgender->bindValue(':clientgender', $clientgender);
        }
        catch(PDOException $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkclientgender->RowCount() < 0) {
            echo "Klant geslacht bestaal al";
        }

        try
        {
            $chkclientaddress = $db->prepare("SELECT `address` FROM `client` WHERE `address` = :clientaddress");
            $chkclientaddress->bindValue(':clientaddress', $clientaddress);
        }
        catch(PDOException $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkclientaddress->RowCount() < 0) {
            echo "Klant adres bestaal al";
        }

        try
        {
            $chkclientcity = $db->prepare("SELECT `city` FROM `client` WHERE `city` = :clientcity");
            $chkclientcity->bindValue(':clientcity', $clientcity);
        }
        catch(PDOException $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkclientcity->RowCount() < 0) {
            echo "Klant stad bestaal al";
        }

        try
        {
            $chkclientzipcode = $db->prepare("SELECT `zipcode` FROM `client` WHERE `zipcode` = :clientzipcode");
            $chkclientzipcode->bindValue(':clientzipcode', $clientzipcode);
        }
        catch(PDOException $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkclientzipcode->RowCount() < 0) {
            echo "Klant zipcode bestaal al";
        }

        try
        {
            $chkclientemail = $db->prepare("SELECT `email` FROM `client` WHERE `email` = :clientemail");
            $chkclientemail->bindValue(':clientemail', $clientemail);
        }
        catch(PDOException $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkclientemail->RowCount() < 0) {
            echo "Klant e-mail bestaal al";
        }

        try
        {
            $chkclientphonenumber = $db->prepare("SELECT `phonenumber` FROM `client` WHERE `phonenumber` = :clientphonenumber");
            $chkclientphonenumber->bindValue(':clientphonenumber', $clientphonenumber);
        }
        catch(PDOException $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkclientphonenumber->RowCount() < 0) {
            echo "Klant voornaam bestaal al";
        }

        try
        {
            $chkclientusername = $db->prepare("SELECT `username` FROM `client` WHERE `username` = :clientusername");
            $chkclientusername->bindValue(':clientusername', $clientusername);
        }
        catch(PDOException $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkclientusername->RowCount() < 0) {
            echo "Klant username bestaal al";
        }

        try
        {
            $chkclientpassword = $db->prepare("SELECT `password` FROM `client` WHERE `password` = :clientpassword");
            $chkclientpassword->bindValue(':clientpassword', $clientpassword);
        }
        catch(PDOException $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkclientpassword->RowCount() < 0) {
            echo "Klant wachtwoord bestaal al";
        }
        #2 querydef
        ?>
        <form action="./do-clientadding.php" method="post">
        <input type="text" name="clientfirstname" value="<?php echo $clientfirstname ?>" >
        <input type="text" name="clientsurname" value="<?php echo $clientsurname ?>" >
        <input type="text" name="clientgender" value="<?php echo $clientgender ?>" >
        <input type="text" name="clientaddress" value="<?php echo $clientaddress ?>" >
        <input type="text" name="clientcity" value="<?php echo $clientcity ?>" >
        <input type="text" name="clientzipcode" value="<?php echo $clientzipcode ?>" >
        <input type="text" name="clientemail" value="<?php echo $clientemail ?>" >
        <input type="text" name="clientphonenumber" value="<?php echo $clientphonenumber ?>" >
        <input type="text" name="clientusername" value="<?php echo $clientusername ?>" >
        <input type="text" name="clientpassword" value="<?php echo $clientpassword ?>" >
        <input type="submit" value="annul" name="annul">
        <input type="submit" value="confirm" name="confirm">
    </form>
    <?php
    }
    ?>
    <?php
    include "./footer.php";
    ?>
</body>
</html>
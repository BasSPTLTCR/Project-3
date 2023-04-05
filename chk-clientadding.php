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
            $chkclientusername = $db->prepare("SELECT `username` FROM `client` WHERE `username` = :clientusername");
            $chkclientusername->bindValue(':clientusername', $clientusername);
            $chkclientusername->execute();
        }
        catch(PDOException $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        if ($chkclientusername->RowCount() > 0) {
            echo "<h2>Username bestaal al</h2>";
            header("Refresh:3; url=frm-clientadding.php");
            die;
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
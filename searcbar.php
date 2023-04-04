<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>alle wilms met startletter B</title>
</head>
<body>
    <?php
    include "./nav.php";
    ?>
    <main>
    <?php
        #1 verbinding database
        require './dbconnenct.php';
                ?>
                <form action="" method="post">
                    <input type="text" name="sup" id="sup">
                    <input type="submit" name="confirm" value="confirm">
                </form>
            <?php
        $country= "";
        if (isset($_POST["sup"])) {
            $sup=  $_POST["sup"];
        }
    try
    {
        $fullQuery = $db->prepare("SELECT supplier.name, supplier.address, country.name AS country, supplier.phonenumber, supplier.email FROM `supplier` INNER JOIN country on supplier.country_id = country.idcountry WHERE supplier.name LIKE :sup");
        $fullQuery->bindValue(':sup', $sup . "%");
    }
    catch(PDOExeption $e) 
    {
        die("Fout bij verbinden met database: " . $e->getMessage());
    }
    #3 querydoen
    $fullQuery->execute();

    #4 checkresult
    if ($fullQuery->RowCount() > 0)
    {
    $result=$fullQuery->FetchAll(PDO::FETCH_ASSOC);

    #5 show result
    ?>
    <table class="tafel">
        <thead>
            <th>name</th>
            <th>address</th>
            <th>country</th>
            <th>phonenumber</th>
            <th>email</th>
        </thead>
        <tbody>
            <?php
                foreach($result as $rij) 
                {
                    echo "<tr><td>" . $rij["name"] . "</td>";
                    echo "<td>" . $rij["address"] . "</td>";
                    echo "<td>" . $rij["country"] . "</td>";
                    echo "<td>" . $rij["phonenumber"] . "</td>";
                    echo "<td>" . $rij["email"] . "</td></tr>";
                }
            ?>

        </tbody>
    </table>
    <?php
    }
    else
    {
        echo "<h2>Sorry, geen resultaat gevonden</h2>";
    }
    #6 geen result melding
    ?>
</main>
<?php
include "./footer.php";
?>
</body>

</html>
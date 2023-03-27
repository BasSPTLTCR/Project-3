<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Leveranciers</title>
</head>

<body>
    <?php
    include "./nav.php";
    ?>
    <main>
        <?php
        #1 verbinding database
        require './dbconnenct.php';

        #2 querydef
        try
        {
            $fullQuery = $db->prepare("SELECT 'name' FROM country ORDER BY `country`.`name` ASC");

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
        <form action="" method="post">
        <select name="country" id="country">
            <option value="">--- Kies een land ---</option>

                <?php
                    foreach($result as $rij) 
                    {
                        echo "<option>".$rij["country"]."</option>";
                    }
                ?>
            </select>
            <input type="submit" name="confirm" value="confirm">
        </form>
        <?php
            }
            $country= "";
            if (isset($_POST["country"])) {
                $country=  $_POST["country"];
            }
            if ($country== "") {
                $country = "%";
            }
            else {
                $country = $country . "%";
            }
        try
        {
            $fullQuery = $db->prepare("SELECT supplier.name, supplier.address, country.name AS countryname, supplier.phonenumber, supplier.email, sum(product.price)/ COUNT(product.id) AS avg FROM `supplier` INNER JOIN country on supplier.country_id = country.idcountry LEFT JOIN product on supplier.id = product.supplier_id GROUP BY supplier.name;");
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
                <th>avarage</th>
            </thead>
            <tbody>
                <?php
                    foreach($result as $rij) 
                    {
                        if ($rij["avg"] != "") {
                            $rij["avg"] = "€" . $rij["avg"];
                        }
                        echo "<tr><td>" . $rij["name"] . "</td>";
                        echo "<td>" . $rij["address"] . "</td>";
                        echo "<td>" . $rij["countryname"] . "</td>";
                        echo "<td>" . $rij["phonenumber"] . "</td>";
                        echo "<td>" . $rij["email"] . "</td>";
                        echo "<td>" . $rij["avg"] . "</td></tr>";
                    }
                ?>

            </tbody>
        </table>
        <?php
        }
        else
        {
            echo "<h2>Sorry,Geen resultaat gevonden</h2>";
        }
        #6 geen result melding
        ?>
    </main>
    <?php
    include "./footer.php";
    #test
    ?>
</body>

</html>

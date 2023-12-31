<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title></title>
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
            $fullQuery = $db->prepare("SELECT client.firstname AS ClientFirstName, client.surname AS ClientSurName, product.name AS ProductName, purchasedate, product.price AS ProductPrice  FROM `orders` INNER JOIN client on orders.clientid = client.id INNER JOIN product on orders.productid = product.id;");

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
                <th>firstname</th>
                <th>surname</th>
                <th>ProductName</th>
                <th>purchasedate</th>
                <th>ProductPrice</th>
            </thead>
            <tbody>
                <?php
                    foreach($result as $rij) 
                    {
                        echo "<tr><td>" . $rij["ClientFirstName"] . "</td>";
                        echo "<td>" . $rij["ClientSurName"] . "</td>";
                        echo "<td>" . $rij["ProductName"] . "</td>";
                        echo "<td>" . $rij["purchasedate"] . "</td>";
                        echo "<td>" . "€" . $rij["ProductPrice"] . "</td></tr>";
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
    ?>
</body>
</html>
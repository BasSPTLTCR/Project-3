<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Klant bestellingen</title>
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
                    $oneQuery = $db->prepare("SELECT DISTINCT product.name AS prod FROM `orderlisting` INNER JOIN product on orderlisting.product_id = product.id ORDER BY `product`.`name` ASC;;");
                }
                catch(PDOExeption $e) 
                {
                    die("Fout bij verbinden met database: " . $e->getMessage());
                }
                #3 querydoen
                $oneQuery->execute();
        
                #4 checkresult
                if ($oneQuery->RowCount() > 0)
                {
                $result=$oneQuery->FetchAll(PDO::FETCH_ASSOC);
        
                #5 show result
                ?>
                <form action="" method="post">
                    <input type="text" name="year" id="year">
                    <input type="submit" name="confirm" value="confirm">
                </form>
            <?php
            $year = '2000-01-01';
            if (isset($_POST["confirm"])) {
                $year = $_POST["year"] . "-01-01";
            }
        #2 querydef
        try
        {
            $fullQuery = $db->prepare("SELECT client.firstname AS ClientFirstName, client.surname AS ClientSurName, orders.purchasedate, COUNT(orderlisting.id) AS orderlist FROM `orders` INNER JOIN client on orders.client_id = client.id INNER JOIN orderlisting on orders.id = orderlisting.order_id WHERE orders.purchasedate >= :year GROUP BY orderlisting.order_id");
            $fullQuery->bindValue(':year', $year);
            
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
                <th>PurchaseDate</th>
                <th>Number of orderlists</th>
            </thead>
            <tbody>
                <?php
                    foreach($result as $rij) 
                    {
                        echo "<tr><td>" . $rij["ClientFirstName"] . "</td>";
                        echo "<td>" . $rij["ClientSurName"] . "</td>";
                        echo "<td>" . $rij["purchasedate"] . "</td>";
                        echo "<td>" . $rij["orderlist"] . "</td></tr>";
                    }
                ?>
            </tbody>
        </table>
        <?php
        }
        else
        {
            echo "<h2>Sorry, geen resultaat gevonden</h2>";
        }}
        #6 geen result melding
        ?>
    </main>
    <?php
    include "./footer.php";
    ?>
</body>
</html>
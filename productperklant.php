<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Producten per klant</title>
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
            $fullQuery = $db->prepare("SELECT client_id AS ClientId, client.firstname AS firstname, client.surname AS lastname ,COUNT(product_id) AS NumberOfProducts FROM `orderlisting` 
            INNER JOIN orders ON orderlisting.order_id = orders.id 
            INNER JOIN client ON orders.client_id = client.id
            GROUP BY client_id ORDER BY client_id;");

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
        <div class="tafel-img">
            <div class="tafeldiv">
                <table class="tafel">
                    <thead>
                        <th>ClientId</th>
                        <th>firstname</th>
                        <th>lastname</th>
                        <th>NumberOfProducts</th>
                    </thead>
                    <tbody>
                        <?php
                            foreach($result as $rij) 
                            {
                                echo "<tr><td>" . $rij["ClientId"] . "</td>";
                                echo "<td>" . $rij["firstname"] ."</td>";
                                echo "<td>" . $rij["lastname"] ."</td>";
                                echo "<td>" . $rij["NumberOfProducts"] . "</td></tr>";
                                
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
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
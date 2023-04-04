<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Klanten</title>
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
            $fullQuery = $db->prepare("SELECT firstname, surname, gender, `address`, city, zipcode, email, COUNT(orders.id) AS NumberOfOrders FROM `client` LEFT JOIN orders ON client.id = orders.clientid GROUP BY client.id;");

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
                <th>gender</th>
                <th>address</th>
                <th>city</th>
                <th>zipcode</th>
                <th>email</th>
                <th>number of orders</th>
            </thead>
            <tbody>
                <?php
                    foreach($result as $rij) 
                    {
                        echo "<tr><td>" . $rij["firstname"] . "</td>";
                        echo "<td>" . $rij["surname"] . "</td>";
                        echo "<td>" . $rij["gender"] . "</td>";
                        echo "<td>" . $rij["address"] . "</td>";
                        echo "<td>" . $rij["city"] . "</td>";
                        echo "<td>" . $rij["zipcode"] . "</td>";
                        echo "<td>" . $rij["email"] . "</td>";
                        echo "<td>" . $rij["NumberOfOrders"] . "</td></tr>";
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
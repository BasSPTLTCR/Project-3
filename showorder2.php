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

        #2 querydef
        try
        {
            $oneQuery = $db->prepare("SELECT DISTINCT product.name AS ProductName FROM `orders` INNER JOIN product ON orders.productid = product.id ORDER BY `ProductName` ASC;");
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
        <select name="ProductName" id="ProductName">
            <option value="">--- Kies een Product ---</option>

                <?php
                    foreach($result as $rij) 
                    {
                        echo "<option>".$rij["ProductName"]."</option>";
                    }
                ?>
            </select>
            <input type="submit" name="confirm" value="confirm">
        </form>
        <?php
        }
        $ProductName = "";
        if (isset($_POST["confirm"])) {
            $ProductName =  $_POST["ProductName"];
        }
        if ($ProductName == "") {
            $ProductName = "%";
        }
        try
        {
            $fullQuery = $db->prepare("SELECT client.firstname AS ClientFirstName, client.surname AS ClientSurName, product.name AS ProductName, purchasedate, product.price AS ProductPrice FROM `orders` INNER JOIN client on orders.clientid = client.id INNER JOIN product on orders.productid = product.id WHERE product.name LIKE :ProductName ;");
            $fullQuery->bindValue(':ProductName', $ProductName);
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
                        echo "<td>" . $rij["ProductPrice"] . "</td></tr>";
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
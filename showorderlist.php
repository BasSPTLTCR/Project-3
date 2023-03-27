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
                    <select name="prod" id="prod">
                    <option value=" ">Kies een Product</option>
                    <?php
                    foreach($result as $rij) 
                    {
                        echo "<option>".$rij["prod"]."</option>";
                    }
                ?>
                    </select>
                    <input type="submit" name="confirm" value="confirm">
                </form>
            <?php
            $year = '2000-01-01';
            if (isset($_POST["confirm"])) {
                $prod = $_POST["prod"];
            }
            if ($prod == "") {
                $prod = "%";
            }
        #2 querydef
        try
        {
            $fullQuery = $db->prepare("SELECT orderlisting.id AS id , product.name AS prodname FROM `orderlisting` INNER JOIN product on orderlisting.product_id = product.id WHERE product.name LIKE :prod");
            $fullQuery->bindValue(':prod', $prod);
            
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
                <th>orderlist_id</th>
                <th>Product</th>
            </thead>
            <tbody>
                <?php
                    foreach($result as $rij) 
                    {
                        echo "<tr><td>" . $rij["id"] . "</td>";
                        echo "<td>" . $rij["prodname"] . "</td></tr>";
                    }
                ?>
            </tbody>
        </table>
        <?php
        }
        else
        {
            echo "<h2>Sorry,Geen resultaat gevonden</h2>";
        }}
        #6 geen result melding
        ?>
    </main>
    <?php
    include "./footer.php";
    ?>
</body>
</html>
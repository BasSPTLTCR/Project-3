<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>
    <?php
    include "./nav.php";
    ?>
    <form action="" method="post">
        <input type="text" name="search" id="search">
        <input type="submit" name="confirm" value="confirm">
    </form>
    <?php
    if (isset($_POST["confirm"])) {
        $search = $_POST["search"];
    }
            #1 verbinding database
            require './dbconnenct.php';

            #2 querydef
            try
            {
                $fullQuery = $db->prepare("SELECT product.name, product.price, supplier.name FROM `product` INNER JOIN supplier ON product.supplier_id = supplier.id WHERE supplier.name LIKE '%$search%';");
    
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
            <table class="tafel2">
                <thead>
                    <th>name</th>
                    <th>price</th>
                    <th>supplier</th>
                </thead>
                <tbody>
                    <?php
                        foreach($result as $rij) 
                        {
                            echo "<tr><td>" . $rij["name"] . "</td>";
                            echo "<td>" . $rij["price"] . "</td>";
                            echo "<td>" . $rij["supplier.name"] . "</td></tr>";
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
    <?php
    include "./footer.php";
    ?>

</body>
</html>
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

    </form>
    <?php
            #1 verbinding database
            require './dbconnenct.php';
        try
        {
            $oneQuery = $db->prepare("SELECT name as CatName FROM `category` ORDER BY `CatName` ASC;");
        }
        catch(PDOExeption $e) 
        {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        #3 querydoen
        $oneQuery->execute();

        #4 checkresult
        if ($oneQuery->RowCount() > 0)
        $result=$oneQuery->FetchAll(PDO::FETCH_ASSOC);

        #5 show result
        ?>
        <form action="" method="post">
        <select name="CatName" id="CatName">
            <option value="">--- Category ---</option>

                <?php
                    foreach($result as $rij) 
                    {
                        echo "<option>".$rij["CatName"]."</option>";
                    }
                ?>
            </select>
            <div>
                <label for="search">Product Naam:</label>
                <input type="text" name="search" id="search">
            </div>
            <div>
                <label for="search_lev">Leverancier Naam:</label>
                <input type="text" name="search_lev" id="search_lev">
            </div>
            <input type="submit" name="confirm" value="confirm">
        </form>
        <?php
                $CatName= "%";
                $search= "%";
                $search_lev= "%";
            if (isset($_POST["confirm"])) {
                $CatName= $_POST["CatName"];
                $search= "%" . $_POST["search"] . "%";
                $search_lev= "%" . $_POST["search_lev"] . "%";
                if ($CatName == "") {
                    $CatName= "%";
                }
                if ($search == "") {
                    $search= "%";
                }
                if ($search_lev == "") {
                    $search_lev= "%";
                }
            }

            #2 querydef
            try
            {
                $fullQuery = $db->prepare("SELECT product.name AS ProductName, product.price, supplier.name AS SupplierName, category.name AS CategoryName FROM `product` INNER JOIN supplier ON product.supplier_id = supplier.id INNER JOIN category on product.category_id = category.id WHERE product.name LIKE :search AND category.name LIKE :CatName AND supplier.name LIKE :search_lev ;");
                $fullQuery->bindValue(':search',$search);
                $fullQuery->bindValue(':CatName', $CatName);
                $fullQuery->bindValue(':search_lev', $search_lev);
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
                    <th>ProductName</th>
                    <th>price</th>
                    <th>SupplierName</th>
                    <th>CategoryName</th>
                </thead>
                <tbody>
                    <?php
                        foreach($result as $rij) 
                        {
                            $totalAmount = number_format($rij["price"], 2, '.', '');
                            $totalAmount = "€" . $totalAmount;
                            echo "<tr><td>" . $rij["ProductName"] . "</td>";
                            echo "<td>" . $totalAmount . "</td>";
                            echo "<td>" . $rij["SupplierName"] . "</td>";
                            echo "<td>" . $rij["CategoryName"] . "</td></tr>";
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
    <?php
    include "./footer.php";
    ?>

</body>
</html>
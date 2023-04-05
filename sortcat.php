<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Categorie sorteren</title>
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
        {
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
            <input type="submit" name="confirm" value="confirm">
        </form>
        <?php
        }
        
    $CatName= "";
    if (isset($_POST["confirm"])) {
        $CatName=  $_POST["CatName"];
    }
    if ($CatName == "") {
        $CatName= "%";
    }
        try
        {
            $fullQuery = $db->prepare("SELECT product.name AS ProductName, product.price AS ProductPrice, category.name AS CategoryName FROM `product` INNER JOIN category on product.category_id = category.id WHERE category.name LIKE :CatName ;");
            $fullQuery->bindValue(':CatName', $CatName);
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
                <th>ProductPrice</th>
                <th>CategoryName</th>
            </thead>
            <tbody>
                <?php
                    foreach($result as $rij) 
                    {
                        echo "<tr><td>" . $rij["ProductName"] . "</td>";
                        echo "<td>" . $rij["ProductPrice"] . "</td>";
                        echo "<td>" . $rij["CategoryName"] . "</td></tr>";
                    }
                ?>
            </tbody>
        </table>
        <?php
        }
        else
        {
            echo "<h2>Sorry, Geen resultaat gevonden</h2>";
        }
        #6 geen result melding
        ?>
    </main>
    <?php
    include "./footer.php";
    ?>
</body>
</html>
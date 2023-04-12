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

        #1 verbinding database
        require './dbconnenct.php';

        #2 querydef
        try
        {
            $fullQuery = $db->prepare("SELECT `name`, price FROM `product`");
            $oneQuery = $db->prepare("SELECT name as CatName FROM `category` ORDER BY `CatName` ASC;");
    
        }
        catch(PDOExeption $e) 
        {
        die("Fout bij verbinden met database: " . $e->getMessage());
        }
        #3 querydoen
        $fullQuery->execute();
        $oneQuery->execute();

        #4 checkresult
        if ($fullQuery->RowCount() > 0 && $oneQuery->RowCount() > 0)
        {
        $result=$fullQuery->FetchAll(PDO::FETCH_ASSOC);
        $result2=$oneQuery->FetchAll(PDO::FETCH_ASSOC);

        #5 show result
        ?>
        <form action="" method="post">
        <select name="CatName" id="CatName">
            <option value="">--- Category ---</option>

                <?php
                    foreach($result2 as $rij2) 
                    {
                        echo "<option>".$rij2["CatName"]."</option>";
                    }
                ?>
            </select>
            <input type="text" name="search2" id="search2">
            <input type="submit" name="confirm" value="confirm">
        </form>
        <?php
                $CatName= "%";
                $search2= "%";
            if (isset($_POST["confirm"])) {
                $CatName= $_POST["CatName"];
                $search2= "%" . $_POST["search2"] . "%";
                if ($CatName == "") {
                    $CatName= "%";
                }
                if ($search2 == "") {
                    $search2= "%";
                }
            }

        echo "<section class='container'>";

            foreach($result as $rij) 
                {
                    $search = array("/", ":", '"');
                    $replace = array("-", "", "");
                    $arr = $rij["name"];
                    $product = (str_replace($search,$replace,$arr));

                    echo "<div class='card'>";
                    echo "<div class='card-image'><img src='./img/product/" . $product . ".png' alt=''class='card-image-image'></div>";
                    echo "<h2>" . $rij["name"] . "</h2>";
                    echo "<p>" ."€" .  $rij["price"] . "<p>";
                    echo "<button class='card-cart'>Add to cart +</button>";
                    echo "</div>";
                }
        echo "</section>";
        }
        else
        {
            echo "<h2>Sorry,Geen resultaat gevonden</h2>";
        }
        #6 geen result melding

        ?>
        <div class="prodfoot">
        <?php
    include "./footer.php";
    ?>
    </div>

</body>

</html>
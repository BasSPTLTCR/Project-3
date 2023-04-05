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
            
        echo "<section class='container'>";

            foreach($result as $rij) 
                {
                    $search = array("/", ":");
                    $replace = array("-", "");
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
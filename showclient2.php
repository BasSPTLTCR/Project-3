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
            $oneQuery = $db->prepare("SELECT city FROM `client`");

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
        <form action="./showclient3.php" method="post">
        <select name="city" id="city">
            <option value="">--- Kies een stad ---</option>

                <?php
                    foreach($result as $rij) 
                    {
                        echo "<option value='".$rij["city"].">".$rij["city"]."</option>";
                    }
                ?>
            </select>
            <input type="submit" value="confirm">
        </form>
        <?php
        }
        if (isset($_POST["confirm"])) {
            $city = $_POST["city"];
        }
        #6 geen result melding

        ?>
    </main>
    <?php
    include "./footer.php";
    ?>
</body>
</html>
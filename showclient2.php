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
            $oneQuery = $db->prepare("SELECT DISTINCT city FROM `client` ORDER BY `client`.`city` ASC;");
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
        <select name="city" id="city">
            <option value="">--- Kies een stad ---</option>

                <?php
                    foreach($result as $rij) 
                    {
                        echo "<option>".$rij["city"]."</option>";
                    }
                ?>
            </select>
            <input type="submit" name="confirm" value="confirm">
        </form>
        <?php
        }
        
        if (isset($_POST["confirm"])) {
            $city = $_POST["city"];
        }
        try
        {
            $fullQuery = $db->prepare("SELECT firstname, surname, gender, `address`, city, zipcode, email FROM `client` WHERE city LIKE '$city'");

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
                        echo "<td>" . $rij["email"] . "</td></tr>";
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
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
            $fullQuery = $db->prepare("SELECT firstname, surname FROM `client`");

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
        <select name="color" id="color">
            <option value="">--- Choose a color ---</option>
            <option value="red">Red</option>
            <option value="green">Green</option>
            <option value="blue">Blue</option>

                <?php
                    foreach($result as $rij) 
                    {
                        echo "<option value='".$rij["city"]."'>"".$rij["city"].""</option>";
                    }
                ?>
            </select>
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Leveranciers per land</title>
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
            $fullQuery = $db->prepare("SELECT COUNT(supplier.id) AS NumberOfSuppliers, country.name AS Country FROM supplier INNER JOIN country on supplier.country_id = country.idcountry WHERE supplier.country_id GROUP BY supplier.country_id;");

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
        <div class="tafel-img">
            <div class="tafeldiv">
                <table class="tafel">
                    <thead>
                        <th>NumberOfSuppliers</th>
                        <th>Country</th>
                    </thead>
                    <tbody>
                        <?php
                            foreach($result as $rij) 
                            {
                                echo "<tr><td>" . $rij["NumberOfSuppliers"] . "</td>";
                                echo "<td>" . $rij["Country"] . "</td></tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
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
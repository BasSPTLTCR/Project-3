<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Landen</title>
</head>

<body>
    <?php
    include "./nav.php";
    ?>
    <main>
        <?php
        #1 verbinding database
        require './dbconnenct.php';

        ?>
        <form action="" method="post">
            <input type="text" name="countname" id="countname">
            <input type="submit" name="confirm" value="confirm">
        </form>
        <?php
        $country = "";
        if (isset($_POST["confirm"])) {
            $countname = $_POST["countname"];
        }
        if (! isset($_POST["confirm"])) {
            $countname = "%";
        }
        try {
            $fullQuery = $db->prepare("SELECT country.name, country.code FROM `country` WHERE country.name LIKE :countname");
            $fullQuery->bindValue(':countname', $countname);
        } catch (PDOExeption $e) {
            die("Fout bij verbinden met database: " . $e->getMessage());
        }
        #3 querydoen
        $fullQuery->execute();

        #4 checkresult
        if ($fullQuery->RowCount() > 0) {
            $result = $fullQuery->FetchAll(PDO::FETCH_ASSOC);

            #5 show result
            ?>
            <table class="tafel">
                <thead>
                    <th>name</th>
                    <th>code</th>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $rij) {
                        echo "<tr><td>" . $rij["name"] . "</td>";
                        echo "<td>" . $rij["code"] . "</td>";
                    }
                    ?>

                </tbody>
            </table>
            <?php
        } else {
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
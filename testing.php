<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Testing</title>
    <link rel="stylesheet" type="text/css" href="company.css">  
</head>
<body>
    <header>
		<h1>Testoutput</h1>
	</header>
 
	<!-- Initialisatie van variabelen -->
    <section>
    <?php 
        require("dbconnencttest.php");
        $currentday = date('Y-m-d');
        $startingday = date('Y-m-d', strtotime($currentday.' - 395 days'));
        $loopdate = $startingday;
        $maxpurlines = 8;
        $paidfull = array(1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1);
        $daystopay = array(1, 0, 0, 2, 1, 3, 4, 1, 5, 1, 6, 7, 8, 1, 9, 3, 10, 4, 11, 0, 1, 12, 0, 6, 13, 0, 4, 14, 1, 15, 1);
        $nextLoopDay = array(1, 0, 0, 2, 1, 3, 0, 1, 5, 1, 6, 0, 2, 1, 1, 3, 0, 4, 1, 0, 1, 2, 0, 6, 3, 0, 4, 4, 1, 5, 1);
        $totnrpurchases = 0;
        $totnrpurchaselines =0;

// Alle klanten id's ophalen en in array zetten om willekeurige klanten te kunnen kiezen
        try 
		{  
			$query = $db->prepare("SELECT id AS idclient FROM client"); 
			$query->execute();	
			if($query->rowCount()>0) 
			{
				$totnrclients = $query->rowCount();
                $indexnrclients = 0;
                $result=$query->fetchAll(PDO::FETCH_ASSOC);
                foreach($result as $rij) {
                    $allclients[$indexnrclients]=$rij["idclient"];
                    $indexnrclients++;
                }
			} else {
                echo "GEEN KLANTEN GEVONDEN !!!!";
                die();
            }

            $randomclient = $allclients[array_rand($allclients)];
        }

        catch(PDOException $e) 
		{ 
			$sMsg = '<p> 
					Regelnummer: '.$e->getLine().'<br /> 
					Bestand: '.$e->getFile().'<br /> 
					Foutmelding: '.$e->getMessage().' 
				</p>'; 
			 
			trigger_error($sMsg); 
		} 

// alle product id's ophalen en in array plaatsen om willekeurig product te kunnen kiezen.
        try 
		{  
			$query = $db->prepare("SELECT id AS idproduct FROM product"); 
			$query->execute();	
			if($query->rowCount()>0) 
			{
					$result=$query->fetchAll(PDO::FETCH_ASSOC);
                    $totnrproducts = $query->rowCount();
                    $indexnrproducts = 0;
                    foreach($result as $rij) {
                        $allproducts[$indexnrproducts]=$rij["idproduct"];
                        $indexnrproducts++;
                    }
    		} else {
                echo "GEEN PRODUCTEN GEVONDEN !!";
                die();
            }
        }

        catch(PDOException $e) 
		{ 
			$sMsg = '<p> 
					Regelnummer: '.$e->getLine().'<br /> 
					Bestand: '.$e->getFile().'<br /> 
					Foutmelding: '.$e->getMessage().' 
				</p>'; 
			 
			trigger_error($sMsg); 
		} 

        ?>
    </section>
    
    <main>

        <?php
            while ($loopdate <= $currentday) {
                // velden vullen voor het purchase record
                $randomclient = $allclients[array_rand($allclients)];
                $purchaseday = $loopdate;
                $paidamount = 0;
                // random beslissen of er betaald is
                $paidfulldecide = $paidfull[array_rand($paidfull)];
                $deliverydecide = $paidfull[array_rand($paidfull)];
                if ($paidfulldecide==1){
                    $paidfullday = date('Y-m-d', strtotime($loopdate.' + '.$daystopay[array_rand($daystopay)].' days'));
                    // als er "betaald" is, random bepalen of er geleverd is
                    if ($deliverydecide==1) {
                        $deliveryday = date('Y-m-d', strtotime($paidfullday.' + '.$daystopay[array_rand($daystopay)].' days'));
                    } else {
                        $deliveryday = "NULL";
                    }
                } else {
                    // als er niet betaald is, de betaaldatum en de afleverdatum op NULL zetten
                    $paidfullday = "NULL";
                    $deliveryday = "NULL";
                }
                // nu zijn alle velden van purchase gevuld en kan de INSERT plaats vinden
                if ($paidfullday<>"NULL") {
                    $paidfullday = date_create_from_format('Y-m-d', $paidfullday)->format('Y-m-d');
                }
                if ($deliveryday<>"NULL") {
                    $deliveryday = date_create_from_format('Y-m-d', $deliveryday)->format('Y-m-d');
                }
                $query = $db->prepare("INSERT INTO orders
                                            (purchasedate, client_id) 
                                VALUES (:purchaseday, :randomclient)");
                $query->bindValue(':purchaseday', $purchaseday);
                $query->bindValue(':randomclient', $randomclient);
                $query->execute();
                $totnrpurchases++;

                // Nu opslaan welke purchase-id zojuist is aangemaakt en bepalen hoeveel purchaselines er komen.
                $purchaserecentid = $db->lastInsertId();
                $nrpurchaselines = random_int(1,$maxpurlines);
                $countamount = 0;
                for ($i=0; $i < $nrpurchaselines; $i++) {
                    $productid = $allproducts[array_rand($allproducts)];
                    try {
                        $selectprod = $db->prepare("SELECT * FROM product WHERE id = $productid");
                        $selectprod->execute();
                        $paidprice = 0;
                        if($selectprod->rowCount()==1) 
                        {
                                $result=$selectprod->fetchAll(PDO::FETCH_ASSOC);
                                foreach ($result as $selectedprod) {
                                    $paidprice = $selectedprod["price"] * 1;
                                }
                        } else {
                            echo "Iets ging vreselijk fout. Aantal producten niet gelijk 1.";
                            die();
                        }
                        if ($paidprice > 1000) {
                            $qty = 1;
                        } else {
                            $qty = random_int(1, 12);
                        }
                        // bewaar het te betalen bedrag voor de update van purchase / paidamount
                        $countamount =+ ($qty * $paidprice);
                    }
            
                    catch(PDOException $e) 
                    { 
                        $sMsg = '<p> 
                                Regelnummer: '.$e->getLine().'<br /> 
                                Bestand: '.$e->getFile().'<br /> 
                                Foutmelding: '.$e->getMessage().' 
                            </p>'; 
                         
                        trigger_error($sMsg); 
                    } 

                    // Alle gegevens voor een purchaseline record zijn bekend. We kunnen invoegen in de db
                    $query = $db->prepare("INSERT INTO orderlisting 
                                        (product_id, 
                                        order_id	
) 
                                    VALUES ($productid, 
                                            $purchaserecentid)"); 
                    $query->execute();
                    $totnrpurchaselines++;

                }

                // ophogen van de purchasedatum in loop met random aantal dagen
                $loopdate = date('Y-m-d', strtotime($loopdate.' + '.$nextLoopDay[array_rand($nextLoopDay)].' days'));

            }
            echo "<p>In totaal zijn weggeschreven:</p>";
            echo "<p>Aantal aankopen (purchase): $totnrpurchases</p>";
            echo "<p>Aantal aankoop regels (purchaseline): $totnrpurchaselines</p>";
        ?>
    </main>	
    
</body>
</html>
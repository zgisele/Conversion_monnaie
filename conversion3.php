<?php
function convertirFCFAenEuro($montantFCFA) {
    $tauxChange = 0.0015;
    $montantEuro = $montantFCFA * $tauxChange;
    return $montantEuro;
}

echo ' <form action="" method="post">
<input type="nomber" placeholder="Entrer le montant a convertir" id="nombre1" name="nombre1" step="1" required    style="color: blue; font-size: 16px;height: 50px;wight: 5px; text-align: center;"><br><br><br> 
<input type="submit" value="CONVERSION" style="background-color: green; color: white ; font-size: 16px;height: 50px;wight: 5px;"> <br><br><br><br>';



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre1"];

         // Vérification si la valeur est un nombre entier positif
        if (is_numeric($nombre) && $nombre >= 0 && filter_var($nombre, FILTER_VALIDATE_INT)) 
        {
            $montantEnEuro = convertirFCFAenEuro($nombre);
            // var_dump($montantEnEuro);
            echo '<input type="nomber" id="nombre2" name="nombre2"   value =" '. $montantEnEuro . '"  style="color:red; font-size: 16px;height: 50px;wight: 5px;  align-items: center; text-align: center;">';
        
        } else {
           
                 echo "Veuillez saisir un nombre entier positif valide.";
        }

} 
session_start();

// Obtenez la date actuelle (heure, jour et mois)
$dateActuelle = date('d M');

// Ajoutez la conversion avec la date à l'historique
$_SESSION['historique'][] = array('Date' => $dateActuelle, 'Montant en FCFA à Convertir' => $nombre, 'Montant de Conversion' => $montantEnEuro);

if (!empty($_SESSION['historique']))
 {
    echo '<H2>Historique des Conversions</H2>';
    
    // Créez un tableau pour stocker les conversions par date
    
    $conversionsParDate = array();

    foreach ($_SESSION['historique'] as $conversion)
     {
        // Obtenez la date de la conversion
        $dateConversion = $conversion['Date'];
        // $dateConversion = substr($conversion['Date'],7,3); // Extrait "d M" (jour et mois)
        
        // Ajoutez la conversion au tableau correspondant à la date
        $conversionsParDate[$dateConversion][] = $conversion;
    }

    
}

   
// Parcourez les conversions par date et affichez-les
    foreach ($conversionsParDate as $date => $conversions) 
{
        echo "<h3>Conversions du $date :</h3>";
        
       
        echo '<ul>';
        foreach ($conversions as $conversion) 
        {
            echo '<li>';
            echo 'Le Montant en FCFA à Convertir = ' . $conversion['Montant en FCFA à Convertir'] . ', ';
            echo 'Montant de Conversion = ' . $conversion['Montant de Conversion'];
            echo '</li>';
        }
        echo '</ul>';     
}

?>

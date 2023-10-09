<?php
function convertirFCFAenEuro($montantFCFA) {
    // Taux de change (1 FCFA équivaut à 0.0015 euro, par exemple)
    $tauxChange = 0.0015;

    // Conversion FCFA en euro
    
    $montantEuro = $montantFCFA * $tauxChange;
   
    return $montantEuro;
}

 // Utilisation de la fonction
// $montantFCFA = 5.2;
// Par exemple, 10 000 FCFA

echo ' <form action="" method="post">
<input type="nomber" placeholder="Entrer le montant a convertir" id="nombre1" name="nombre1" step="1" required    style="color: blue; font-size: 16px;height: 50px;wight: 5px; text-align: center;"><br><br><br> 
<input type="submit" value="CONVERSION" style="background-color: green; font-size: 16px;height: 50px;wight: 5px;"> <br><br><br><br>';

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





// Tableau de données d'historique
session_start(); // Démarre la session (si ce n'est pas déjà fait)


$_SESSION['historique'][] = array('Montant en FCFA à Convertir' => $nombre, 'Montant de Conversion' => $montantEnEuro);

if (!empty($_SESSION)) {
    echo '<H2>Historique des Conversions</H2>';
    foreach ($_SESSION['historique'] as $conversion) 
    {
        echo "<ul>";
        echo '<li>Le Montant en FCFA à Convertir = ' . $conversion['Montant en FCFA à Convertir'] . ', le Montant de Conversion = ' . $conversion['Montant de Conversion'] . '</li>';
        echo " </ul>";
    }
} else {
    echo 'L\'historique est vide.';
}
?>
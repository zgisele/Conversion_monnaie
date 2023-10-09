<?php
function convertirFCFAenEuro($montantFCFA) {
    $tauxChange = 0.0015;
    $montantEuro = $montantFCFA * $tauxChange;
    return $montantEuro;
}

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



session_start(); // Démarre la session (si ce n'est pas déjà fait)

// Obtenez la date actuelle (heure, jour et mois)
$dateActuelle = date('H:i d M');
$montantEnEuro = convertirFCFAenEuro($nombre);

// Ajoutez la conversion avec la date à l'historique
$_SESSION['historique'][] = array(

    'Date' => $dateActuelle,
    'Montant en FCFA à Convertir' => $nombre,
    'Montant de Conversion' => $montantEnEuro
);

if (!empty($_SESSION['historique'])) {
    echo '<H2>Historique des Conversions</H2>';
    echo '<ul>';
    foreach ($_SESSION['historique'] as $conversion) {
        echo '<li>';
        echo 'Date : ' . $conversion['Date'] . ', ';
        echo 'Montant en FCFA à Convertir = ' . $conversion['Montant en FCFA à Convertir'] . ', ';
        echo 'Montant de Conversion = ' . $conversion['Montant de Conversion'];
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo 'L\'historique est vide.';
}



?>
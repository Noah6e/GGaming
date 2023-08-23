<!--FORMULAIRE.php -->
<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $email = $_POST["email"];
    $lieu_residence = $_POST["lieu_residence"];
    $date_anniversaire = $_POST["date_anniversaire"];

    // Ici, vous pouvez valider les données t les stocker dans une base de données
    
    //Vérification de la connexion
    if ($con->connect_error) {
        die("Erreur de connexion a la base de données: " .$conn->connect_error);
    }
    //Préparation de la requete d'insertion
    $sql= "INSERT INTO clients (nom, prenom, email, lieu_residence, date_anniversaire)
    VALUES ('$nom', '$prenom', '$email','$lieu_residence', 'date_anniversaire')";

    if($conn->query($sql) === TRUE) {
        echo "Données enregistrées avec succès.";
    } else{
        echo "Erreur d'enregistrement des données: ". $conn->error;
    }
    $conn->close();

}
?>
// Connexion à la base de donnees
$conn = new mysqli("localhost", "nom_utilisateur", "mot_de_passe", "nom_base_de_données");

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données: " . $conn->connect_error);
}

// Utilisation d'une requête préparée pour insérer des données
$stmt = $conn->prepare("INSERT INTO clients (nom, prenom, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nom, $prenom, $email);

// Assurez-vous d'échapper les données et de les valider avant d'affecter les variables
$nom = mysqli_real_escape_string($conn, $_POST["nom"]);
$prenom = mysqli_real_escape_string($conn, $_POST["prenom"]);
$email = mysqli_real_escape_string($conn, $_POST["email"]);

// Exécution de la requête
if ($stmt->execute()) {
    echo "Données enregistrées avec succès.";
} else {
    echo "Erreur d'enregistrement des données: " . $stmt->error;
}

// Fermeture de la connexion et du statement
$stmt->close();
$conn->close();

<?php
$json_contenu = file_get_contents("data.json");
$data = json_decode($json_contenu, true);
if(isset($_POST)){
    if(isset($_POST['login'])){
        $trouve = false;
        foreach ($data as $elm){
            if($elm['user'] == $_POST['user'] && $elm['password'] == $_POST['password']){
                $trouve = true;
                break;
            }
        }
        if($trouve){
            echo "connexion etablie";
        }else{
            echo "connexion echouée";
        }
    }

    if(isset($_POST['signin'])){
        $trouve = false;
        foreach ($data as $elm){
            if($elm['user'] == $_POST['user']){
                $trouve = true;
                break;
            }
        }
        if($trouve){
            echo "utilisateur existant";
        }else{
            $nouvelle_entree = array("user" => $_POST['user'], "password" => $chaine_base64 = $_POST['password']);
            array_push($data, $nouvelle_entree);

            // Encoder le tableau mis à jour en JSON
            $nouveau_json = json_encode($data, JSON_PRETTY_PRINT);

            // Écrire les données mises à jour dans le fichier JSON
            if (file_put_contents("data.json", $nouveau_json)) {
                echo "inscription etablie";
            } else {
                echo "Erreur lors de l'écriture dans le fichier";
            }
        }
    }
}
?>
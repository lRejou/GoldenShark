# GoldenShark
Projet sous Symfony 4

# Instalation du projet
 - Avoir PHP 7.3 ( 7.truc marche aussi normalement )
 - Avoir composer
 - Avoir un Mysql
# Commandes d'instalation
 - "composer install"
 - "php bin/console doctrine:database:create"
 - "php bin/console doctrine:migrations:migrate"
 - "php bin/console server:run"
 
# Modification de la BDD
 - Pour modifier une entity "php bin/console make:entity"
 - Pour généré la migration "php bin/console make:entity"
 - Exécuter la migrations et actualiser le BDD "php bin/console doctrine:migrations:migrate"

# Pour les requetes sur le serveur Minecraft

Normalement il faudrait que tu es un serveur minecraft en local pour faire des test. Mais en vrai pas besoin ... On est des fou ! On requete direct sur la prod
Sur le serveur minecraft le Plugin est JSONAPI. doc : https://docs.asylyus.fr/JSONAPI-RELOADED/
Dans le doc tu trouveras toutes les fonctions utilisable

Pour les utiliser l'API se trouve dans "src/entity/JsonAPI.php"

Code PHP exemple :
$myapi = new JSONAPI("51.75.186.103" , "30581" , "admin" , "changeme");
$myEco = $myapi->call("econ.getBalance" , ["Presussit_in_Ore"]);



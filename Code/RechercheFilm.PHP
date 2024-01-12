<?php require 'Views/begin.html'; ?>

<form method="get" role="search">
  <label for="search">Recherchez un acteur</label>
  <input id="search" name="film" type="search" placeholder="Entrez un nom" autofocus required />
  <button type="submit">GO</button>    
</form>

<?php 
$recherchefilm = new RechercheFilm();
$recherchefilm ->action_rechercheFilm();
class RechercheFilm{
  private $bd;

  public function __construct() 
  {
    include "/home/a2sq/Documents/BUT2/Sae-BDD-Films/code/credentials.php";
    try {
      $this->bd = new PDO($dsn, $login, $password);
      $this->bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->bd->query("SET names 'utf8'");
    } catch (PDOException $e) {
      echo "Erreur de connexion à la base de données : " . $e->getMessage();
    }
  }

  public function getFilmName($name)
  {
    try {
      $requete = $this->bd->prepare('SELECT titlebasics.originaltitle FROM titlebasics WHERE originaltitle ~* :name LIMIT 30;');
      $requete->bindValue(':name', $name);
      $requete->execute();
      return $requete->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
    }
  }
  //test

  public function action_rechercheFilm(){
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

      $recherche = strtolower($_GET['film']); // Convertit la recherche en minuscules pour une correspondance insensible à la casse

      if (strlen($recherche) >= 3){
        $data = $this->getFilmName($recherche);
        if (!empty($data)){
            echo '<div class="resultats">';
            foreach ($data as $val) {
                echo '<p class="resultat">' . $val['originaltitle'] . "</p>";
        }
          echo '</div>';
        }
        else {
          echo '<p class="resultat">Aucun acteur correspondant à votre recherche</p>';
        }
      }
    } else {
      echo '<div class="resultat"><p class="resultat">Veuillez entrer au moins 3 caractères</p></div>';
    }
  }
}

require 'Views/end.html';
?>

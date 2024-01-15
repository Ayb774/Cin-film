<?php include 'Views/begin.html'; ?>

<form method="get">

    <label>
        <input type="text" id="yearInput" name="yearInput" placeholder="Année de naissance (----)" pattern="[0-9]{4}" maxlength="4">
        <input type="radio" name="critere" value="yearInput"> year
    </label>
    <br>
    <label>
        <input type="text" id="deathYearInput" name="deathYearInput" placeholder="Année de décès (----)" pattern="[0-9]{4}" maxlength="4">
        <input type="radio" name="critere" value="deathYearInput"> deathyear
    </label>
    <br>
    <label>
        <input type="text" id="profession" name="profession" placeholder="profession">
        <input type="radio" name="critere" value="profession"> primaryprofession
    </label>
    <br>
    <label>
        <input type="text" id="titre" name="titre" placeholder="titre">
        <input type="radio" name="critere" value="titre"> knownfortitle
    </label>
    <br>
    <br>
    <label>
        <input type="text" name="recherche" placeholder="recherche">
    </label>
    <input type="submit" value="rechercher">
</form>

<?php 

$rechercheAvancee = new RechercheAvancee();
$rechercheAvancee -> action_recherche();

Class RechercheAvancee{
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

    public function getNameActor($name, $critereType, $critere)
    {
        try {
            if ($critereType == 'yearInput'){
                $requete = $this->bd->prepare('SELECT primaryname FROM namebasics WHERE primaryprofession ~* $$actor|actress$$ 
                and primaryname ~* :name and birthyear = :critere LIMIT 10;');
                $requete->bindValue(':critere', $critere);

            }
            else if ($critereType == 'deathYearInput'){
                $requete = $this->bd->prepare('SELECT primaryname FROM namebasics WHERE primaryprofession ~* $$actor|actress$$ 
                and primaryname ~* :name and deathyear = :critere LIMIT 10;');
                $requete->bindValue(':critere', $critere);
            }
            else if ($critereType == 'profession'){
                $requete = $this->bd->prepare('SELECT primaryname FROM namebasics WHERE primaryprofession ~* $$actor|actress$$ 
                and primaryname ~* :name and primaryProfession ~* :critere LIMIT 10;');
                $requete->bindValue(':critere', $critere);
            }
            else if ($critereType == 'titre'){
                $requete = $this->bd->prepare('SELECT primaryname FROM namebasics WHERE primaryprofession ~* $$actor|actress$$ 
                and primaryname ~* :name and knownForTitles ~* :critere LIMIT 10;');
                $requete->bindValue(':critere', $critere);
            }
        $requete->bindValue(':name', $name);
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
        echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
        }
    }


    public function action_recherche(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            $critere = isset($_GET['critere']) ? $_GET['critere'] : '' ;
            $recherche = isset($_GET['recherche']) ? $_GET['recherche'] : '';
            $birthyear = isset($_GET['yearInput']) ? $_GET['yearInput'] : '';
            $deathyear = isset($_GET['deathYearInput']) ? $_GET['deathYearInput'] : '';
            $profession = isset($_GET['profession']) ? $_GET['profession'] : '';
            $titre = isset($_GET['titre']) ? $_GET['titre'] : '';

            if (!empty($birthyear)){
                $data = $this->getNameActor($recherche, $critere, $birthyear);
                echo '<div class="resultats">';
                foreach ($data as $val) {
                    echo "<p class='resultat'>" . $val['primaryname'] . "</p>";
                }
                echo '</div>';
                }
            else {
                echo '<p class="resultat">Aucun acteur correspondant à votre recherche</p>';
            }

            if (!empty($deathyear)){
                $data = $this->getNameActor($recherche, $critere, $deathyear);
                echo '<div class="resultats">';
                foreach ($data as $val) {
                    echo "<p class='resultat'>" . $val['primaryname'] . "</p>";
                }
                echo '</div>';
                }
            else {
                echo '<p class="resultat">Aucun acteur correspondant à votre recherche</p>';
            }

            if (!empty($profession)){
                $data = $this->getNameActor($recherche, $critere, $profession);
                echo '<div class="resultats">';
                foreach ($data as $val) {
                    echo "<p class='resultat'>" . $val['primaryname'] . "</p>";
                }
                echo '</div>';
                }
            else {
                echo '<p class="resultat">Aucun acteur correspondant à votre recherche</p>';
            }

            if (!empty($titre)){
                $data = $this->getNameActor($recherche, $critere, $titre);
                echo '<div class="resultats">';
                foreach ($data as $val) {
                    echo "<p class='resultat'>" . $val['primaryname'] . "</p>";
                }
                echo '</div>';
                }
            else {
                echo '<p class="resultat">Aucun acteur correspondant à votre recherche</p>';
            }
        }
    }
    

}























?>











<?php include 'Views/end.html'; ?>

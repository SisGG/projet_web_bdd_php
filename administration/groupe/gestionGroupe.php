<?php
  session_start();
  include_once(dirname(__FILE__).'/../../fonctions/variables.php');
  include_once(dirname(__FILE__).'/../../fonctions/fonction_compte.php');
  include_once(dirname(__FILE__).'/../../fonctions/fonction_groupe.php');
  include_once(dirname(__FILE__).'/../../bdd/connexion.php');

  $info['head']['subTitle'] = "Gestion groupe";
  $info['head']['stylesheets'] = ['adminGestion.css'];

  if(!is_connect() || !is_admin()) {leave();}

  /* Récupération des variables importantes pour le cas suivant :
   * cas supprimer
   */
  $idRecompense = $_GET['idGroupe'];

  /* Fichier de fonction exécuter suivant le cas suivant :
   * supprimer un groupe avec action = supprimerGroupe
   */
  include_once(dirname(__FILE__).'/actionGroupe.php');

  $listeGroupe = recuperer_groupe_tous($db);

  include_once(dirname(__FILE__).'/../../head.php');
?>

<?php include_once(dirname(__FILE__).'/../../header.php'); ?>

<main>
  <section>
    <?php include_once(dirname(__FILE__).'/../adminHeader.php'); ?>
    <section class="text-center">
      <?php include_once(dirname(__FILE__).'/headerGroupe.php'); ?>
      <div>
        <table id="tableauGestion">
          <tr class="table-head">
            <th class="width-350">Nom groupe</th>
            <th class="width-250">Date groupe</th>
            <th class="width-700">Description</th>
          </tr>

          <?php foreach($listeGroupe as $groupe) { /* INFORMATION POUR CHAQUE ARTISTES AVEC ACTION */ ?>
          <tr class="table-lign">
            <td><?php echo $groupe['nomgroupe']; ?></td>
            <td><?php echo $groupe['dategroupe']; ?></td>
            <td><?php echo $groupe['descriptiongroupe']; ?></td>
            <td class="button button-blue">
              <a href="./formGroupe.php?idGroupe=<?php echo $groupe['idgroupe']; ?>">Modifier</a>
            </td>
            <td class="button button-red">
              <a href="?action=supprimerGroupe&idGroupe=<?php echo $groupe['idgroupe']; ?>">Supprimer</a>
            </td>
          </tr>
          <?php } ?>

        </table>
      </div>
    </section>
  </section>
</main>
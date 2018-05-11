<?php

/**
 * FICHIER : FUNCTIONS -> fonctionMusique.PHP
 * Fichier des fonctions de gestion des musiques.
 */

/**
 * Récupère tout les musiques de la BDD en les triant
 * par ordre alphabétique par leur titre
 * @param $db PDO Instance PDO de connexion à la BDD
 * @return array Toutes les musiques dans la BDD.
 */
function recuperer_musique_tous($db) {
  $req = $db->prepare("SELECT * FROM Musique ORDER BY titreMusique ASC");
  $req->execute();
  $res = $req->fetchAll();
  return $res;
}

/***
 * Récupère une musique de la BDD
 * spécifier par l'identifiant 'idMusique'.
 * @param $db PDO Instance PDO de connexion à la BDD
 * @param $idMusique Int Identifiant de la musique
 * @return array La musique, elle est unique | Null sinon
 */
function recuperer_musique($db, $idMusique) {
  $req = $db->prepare("SELECT * FROM Musique WHERE idMusique=:idMusique");
  $req->bindParam(':idMusique', $idMusique);
  $req->execute();
  $res = $req->fetchAll();
    return $res;
}

/**
 * Ajoute une nouvelle musique à la BDD avec un titre, duree,
 * date de sortie et une description de la musique.
 * @param $db PDO Instance PDO de connexion à la BDD
 * @param $titreMusique String titre de la musique
 * @param $dureeMusique Int duree de la musique
 * @param $dateMusique DateTime Date de sorite de la musique
 * @param $descriptionMusique String Description de la musique
 * @return Int idMusique si la requete s'est bien exécutée | Null Sinon
 */
function ajouter_musique($db, $titreMusique, $dureeMusique, $dateMusique, $descriptionMusique) {
  $req = $db->prepare("INSERT INTO Musique(titreMusique, dureeMusique, dateMusique, descriptionMusique)
      VALUES(:titreMusique, :dureeMusique, :dateMusique, :descriptionMusique);");
  $req->bindParam(':titreMusique', $titreMusique, PDO::PARAM_STR);
  $req->bindParam(':dureeMusique', $dureeMusique, PDO::PARAM_INT);
  $req->bindParam(':dateMusique', format_date($dateMusique));
  $req->bindParam(':descriptionMusique', $descriptionMusique, PDO::PARAM_STR);
  $reqOk = $req->execute();
  if ( $reqOk ) {
    $idMusique = $db->lastInsertId();
    return $idMusique;
  }
  return null;
}

/**
 * Modifier une musique existante dans la BDD avec un titre, duree,
 * date de sortie et une description de la musique.
 * @param $db PDO Instance PDO de connexion à la BDD
 * @param $idMusique Int Identifiant de la musique
 * @param $titreMusique String titre de la musique
 * @param $dureeMusique Int duree de la musique
 * @param $dateMusique DateTime Date de sorite de la musique
 * @param $descriptionMusique String Description de la musique
 * @return True si la requete s'est bien exécutée | False Sinon
 */
function modifier_musique($db, $idMusique, $titreMusique, $dureeMusique, $dateMusique, $descriptionMusique) {
  $req = $db->prepare("UPDATE Musique SET titreMusique=:titreMusique, dureeMusique=:dureeMusique, dateMusique=:dateMusique, descriptionMusique=:descriptionMusique WHERE idMusique=:idMusique;");
  $req->bindParam(':idMusique', $idMusique, PDO::PARAM_INT);
  $req->bindParam(':titreMusique', $titreMusique, PDO::PARAM_STR);
  $req->bindParam(':dureeMusique', $dureeMusique, PDO::PARAM_INT);
  $req->bindParam(':dateMusique', format_date($dateMusique));
  $req->bindParam(':descriptionMusique', $descriptionMusique, PDO::PARAM_STR);
  $reqOk = $req->execute();
  return $reqOk;
}

/**
 * Supprime une musique de la BDD
 * spécifier par l'identifiant 'idMusique'.
 * @param $db PDO Instance PDO de connexion à la BDD
 * @param $idMusique Int Identifiant de la musique
 * @return True si la suppression s'est bien exécutée | False Sinon
 */
function supprimer_musique($db, $idMusique) {
  $req = $db->prepare("DELETE FROM Musique WHERE idMusique=:idMusique;");
  $req->bindParam(':idMusique', $idMusique, PDO::PARAM_INT);
  $reqOk = $req->execute();
  return $reqOk;
}

/**
 * Recupere les associations de musiques et leur compositeur
 * @param $db PDO Instance PDO de connexion à la BDD
 * @param $idMusiqueCoMu Int Identifiant musique dans Composer_album
 * @return array Association des musiques et de leur compositeur
 */
function recuperer_composer_musique($db, $idMusiqueCoMu) {
  $req = $db->prepare("SELECT * FROM Composer_Musique WHERE idMusiqueCoMu=:idMusiqueCoMu");
  $req->bindParam(':idMusiqueCoMu', $idMusiqueCoMu, PDO::PARAM_INT);
  $req->execute();
  $res = $req->fetchAll();
  return $res;
}

/**
 * Ajoute une association entre une musique et son compositeur
 * @param $db PDO Instance PDO de connexion à la BDD
 * @param $idMusiqueCoMu Int Identifiant musique dans Composer_Musique
 * @param $idArtisteCoMu Int Identifiant artiste dans Composer_Musique
 * @return True si la requete s'est bien exécutée | False sinon
 */
function ajouter_composer_musique($db, $idMusiqueCoMu, $idArtisteCoMu) {
  $req = $db->prepare("INSERT INTO Composer_Musique(idMusiqueCoMu, idArtisteCoMu)
      VALUES(:idMusiqueCoMu, :idArtisteCoMu);");
  $req->bindParam(':idMusiqueCoMu', $idMusiqueCoMu, PDO::PARAM_INT);
  $req->bindParam(':idArtisteCoMu', $idArtisteCoMu, PDO::PARAM_INT);
  $reqOk = $req->execute();
  return $reqOk;
}
/**
 * Supprime toutes les association de la table Composer_Musique
 * spécifié par l'identifiant 'idAlbumCoAl'.
 * @param $db PDO Instance PDO de connexion à la BDD
 * @param $idMusiqueCoMu Int Identifiant album dans Composer_Musique
 * @return True si la requete s'est bien exécutée | False sinon
 */
function supprimer_composer_musique_tous($db, $idMusiqueCoMu) {
  $req = $db->prepare("DELETE FROM Composer_Musique WHERE idMusiqueCoMu=:idMusiqueCoMu;");
  $req->bindParam(':idMusiqueCoMu', $idMusiqueCoMu, PDO::PARAM_INT);
  $reqOk = $req->execute();
  return $reqOk;
}

/**
 * Recupere les associations de musiques et leur album
 * @param $db PDO Instance PDO de connexion à la BDD
 * @param $idMusiqueAa Int Identifiant musique dans Assembler_Album
 * @return array Association des musiques et de leur album
 */
function recuperer_assembler_album($db, $idMusiqueAa) {
  $req = $db->prepare("SELECT * FROM Assembler_Album WHERE idMusiqueAa=:idMusiqueAa");
  $req->bindParam(':idMusiqueAa', $idMusiqueAa, PDO::PARAM_INT);
  $req->execute();
  $res = $req->fetchAll();
  return $res;
}

/**
 * Ajoute une association entre une musique et un album
 * @param $db PDO Instance PDO de connexion à la BDD
 * @param $idMusiqueAa Int Identifiant musique dans Assembler_Album
 * @param $idAlbumAa Int Identifiant album dans Assembler_Album
 * @param $numeroPiste Int Numero de la musique dans l'album
 * @return True si la requete s'est bien exécutée | False sinon
 */
function ajouter_assembler_album($db, $idMusiqueAa, $idAlbumAa, $numeroPiste) {
  $req = $db->prepare("INSERT INTO Assembler_Album(idMusiqueAa, idAlbumAa, numeroPiste)
      VALUES(:idMusiqueAa, :idAlbumAa, :numeroPiste);");
  $req->bindParam(':idMusiqueAa', $idMusiqueAa, PDO::PARAM_INT);
  $req->bindParam(':idAlbumAa', $idAlbumAa, PDO::PARAM_INT);
  $req->bindParam(':numeroPiste', $numeroPiste, PDO::PARAM_INT);
  $reqOk = $req->execute();
  return $reqOk;
}

/**
 * Supprime toutes les association de la table Assembler_Album
 * spécifié par l'identifiant 'idAlbumCoAl'.
 * @param $db PDO Instance PDO de connexion à la BDD
 * @param $idAlbumAa Int Identifiant album dans Assembler_Album
 * @return True si la requete s'est bien exécutée | False sinon
 */
function supprimer_assembler_album_tous($db, $idAlbumAa) {
  $req = $db->prepare("DELETE FROM Assembler_Album WHERE idMusiqueAa=:idMusiqueAa;");
  $req->bindParam(':idMusiqueAa', $idAlbumAa, PDO::PARAM_INT);
  $reqOk = $req->execute();
  return $reqOk;
}

?>
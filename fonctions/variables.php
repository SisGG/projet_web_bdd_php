<?php

function format_date($date) {
    if ( isset($date) && !empty($date) ) {
        return date("d-m-Y", strtotime($date));
    }
    return null;
}

function date_valide($date) {
	//verification format
	$pattern1 = '/^[0-9]{2}-[0-9]{2}-[0-9]{4}/';
	$pattern2 = '/^[0-9]{2}/[0-9]{2}/[0-9]{4}/';
	if ( !preg_match($pattern1, $date) && !preg_match($pattern2, $date) )
		return false;
	
	//date actuelle
	$jour = intval(date('j'));
	$mois = intval(date('m'));
	$annee = intval(date('Y'));

    //date en paramètre
	$j_verif = intval($date[0].$date[1]);
	$m_verif = intval($date[3].$date[4]);
	$y_verif = intval($date[6].$date[7].$date[8].$date[9]);
	
	//Verification
	if ( $y_verif < $annee )
		return true;
	else if ( $y_verif > $annee )
		return false;
	else if ( $y_verif == $annee ) {
		if ( $m_verif < $mois )
			return true;
		else if ( $m_verif > $mois )
			return false;
		else if ( $m_verif == $mois ) {
			if ( $j_verif <= $jour ) 
				return true;
			else
				return false;
		}
	}			
}

function format_duree($secondes) {
	$minutes = intdiv($secondes,60);
	$secondes = $secondes % 60;
	return("$minutes min $secondes s");
}

$info = [
    'head' => [
        'title' => "Mon projet"
    ],
    'bdd' => [
        'postgres' => [
            'db_name' => 'bd_web',
            'db_host' => 'localhost',
            'db_user' => 'postgres',
            'db_pwd' => '1234567890'

        ],
        'mysql' => [
            'db_name' => 'bd_web',
            'db_host' => 'localhost',
            'db_user' => 'user',
            'db_pwd' => '1234567890'   
        ]
    ]
];

$messages = [
    'formulaire' => [
        'champs_obligatoire' => "Certains champs du formulaire sont obligatoire.",
        'champs_vide' => "Certains champs du formulaire sont vide.",
        'invalide' => "Le formulaire est incomplet.",
        'dateInvalide' => "La date n'est pas valide (dd-mm-yyy).",
        'motDePasseDifferent' => "Les deux mot de passe ne sont pas identique.",
        'erreurDevenirUtilisateur' => "Vous ne pouvez pas devenir utilisateur normal.",
        'erreurSupprimerSonCompte' => "Vous ne pouvez pas supprimer votre propre compte.",
        'valeurNegative' => "La valeur renseigné doit être positive."
    ],
    'connexion' => [
        'incorrect' => "Votre identifiant ou votre mot de passe est incorrect.",  
    ],
    'inscription' => [
        'utilisateurExistant' => "Ce nom d'utilisateur existe déjà.",
    ],
    'minimum1Artiste' => "Il faut au minimum un artiste sélectionné.",
    'minimum2Artiste' => "Il faut au minimum deux artistes sélectionnés.",
    '1titreMusique' => "Il faut seulement un titre de musique sélectionner.",
    'operation' => [
        'ok' => "L'opération a été effectué.",
        'ko' => "L'opération n'a pas pu être effectué."
    ]
]

?>
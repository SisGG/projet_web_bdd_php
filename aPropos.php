<?php

/**
 * @file aPropos.php
 * @brief Présente les auteurs, leur contact et le but du site
 */

session_start();
include_once(dirname(__FILE__).'/fonctions/variables.php');
include_once(dirname(__FILE__).'/fonctions/fonctionCompte.php');
include_once(dirname(__FILE__).'/bdd/connexion.php');

$info['head']['subTitle'] = "A propos";
$info['head']['stylesheets'] = ['accueil.css', 'aPropos.css'];

include_once(dirname(__FILE__).'/head.php');

?>

<?php include_once(dirname(__FILE__).'/header.php'); ?>

<main>
    <section>

        <div id="page-apropos" class="t18 text-center">
            <div>
                <h1 class="red1 t35">Le projet Web</h1>
                <div>
                    Ce site est le produit d'un projet de la filière Systèmes de Télécommunications, Réseaux et Informatique. Notre groupe composé de 5 étudiants
                    avait pour but de réaliser un site fonctionnel de critiques sur des oeuvres musicales. Ainsi, le site internet sur lequel vous naviguez en ce moment même
                    est le résultat de semaines de travail sur les langages HTML, CSS, PHP ainsi que sur l'utilisation d'une base de données.
                </div>
            </div>

            <div>
                <h1 class="red1 t35"> L'équipe </h1>
                <ul>
                    <li> LABORDE Tonin : tonin.laborde@univ-tlse3.fr</li>
                    <li> LAPEYRADE Sylvain : sylvain.lapeyrade@univ-tlse3.fr</li>
                    <li> OLIVIER Thomas : thomas.olivier@univ-tlse3.fr</li>
                    <li> ROBERT DE ST VINCENT Guillaume : guillaume.robert-de-saint-vincent@univ-tlse3.fr</li>
                    <li> WATHOJE Emmanuel : emmanuel.wathoje@univ-tlse3.fr</li>
                </ul>
                
                <div>
                    <h1 class="red1 t35"> Comment ça marche ? </h1>
                    <p> Pour avoir un aperçu des fonctionnalités du site regardez cette vidéo de présentation : <a class="red1" href="https://www.youtube.com/watch?v=4C64b4QqI_E" target="_blank">cliquer ici</a></p>
                </div>
                
                <div>
                    Vous pouvez retrouver le code source du projet sur notre depôt :<br>
                    <span class="red1">Depôt GitHub</span> : <a href="https://github.com/SisGG/projet_web_bdd_php">https://github.com/SisGG/projet_web_bdd_php</a>
                </div>
            </div>
        </div>
        
    </section>
</main>

<?php include_once(dirname(__FILE__).'/footer.php'); ?>

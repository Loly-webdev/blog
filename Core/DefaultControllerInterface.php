<?php

interface DefaultControllerInterface
{
    // methode d'action par defaut
    public function indexAction();
    // affichage de la vue et de ses parametres
    public function renderView(string $view, array $params, string $viewFolder = null ) : void;
    // chemin du fichier des vues demandees
    public function getFolderView() : string;
    // pour instancie l'objet request sans le repeter a chaque fois
    public function getRequest();
}

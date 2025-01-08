<?php

namespace Romai\SaeWeb;

class traitement implements IFormRepository
{
    public function __construct(private \PDO $dbConnexion){ }

    public function saveForm(Form $form) : bool {

        $stmt = $this->dbConnexion->prepare(
            "INSERT INTO formulaire (idUser, region, age, lieuDeVie, adaptationCDAPH, lieuVoulu, activite, qualiteDeVie, besoinIntervention) VALUES (:idUser, :region, :age, :lieuDeVie, :adaptationCDAPH, :lieuVoulu, :activite, :qualiteDeVie, :besoinIntervention)"
        );
        return $stmt->execute(array(
            'idUser' => $form->getId(),
            'region' => htmlspecialchars($form->getRegion()),
            'age' =>$form->getAge(),
            'lieuDeVie' => $form->getLieuVie(),
            'adaptationCDAPH' => $form->getAdaptationCDAPH(),
            'lieuVoulu' => $form->isLieuVoulu(),
            'activite' => htmlspecialchars($form->getActivite()),
            'qualiteDeVie' => htmlspecialchars($form->getQualiteVie()),
            'besoinIntervention' => htmlspecialchars($form->getBesoinIntervention()),
        ));
    }

}
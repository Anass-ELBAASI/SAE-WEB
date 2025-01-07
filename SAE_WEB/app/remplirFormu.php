<?php

namespace Romai\SaeWeb;

class remplirFormu
{
    public function __construct(private IFormRepository $formRepository) { }

    public function enregistrerForm(int $id, string $region, int $age, string $lieuVie, string $adaptationCDAPH, bool $lieuVoulu, string $activite, string $qualiteVie, string $besoinIntervention){
        $register = new Form($id, $region, $age, $lieuVie, $adaptationCDAPH ,$lieuVoulu, $activite, $qualiteVie, $besoinIntervention);
    return $this->formRepository->saveForm($register);
}
}
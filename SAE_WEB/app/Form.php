<?php

namespace Romai\SaeWeb;

class Form
{
    public function __construct(private int $id, private string $region, private int $age, private string $lieuVie, private string $adaptationCDAPH, private bool $lieuVoulu, private string $activite, private string $qualiteVie, private string $besoinIntervention){ }

    public function getBesoinIntervention(): string {return $this->besoinIntervention; }
    public function getActivite(): string{ return $this->activite; }
    public function isLieuVoulu(): bool{ return ($_POST['choix_vie'] === "Oui"); }
    public function getAdaptationCDAPH(): string{ return $this->adaptationCDAPH; }
    public function getLieuVie(): string { return $this->lieuVie; }
    public function getAge(): int { return $this->age; }
    public function getRegion(): string { return $this->region; }
    public function getId(): int{ return $this->id; }
    public function getQualiteVie(): string { return $this->qualiteVie; }
}
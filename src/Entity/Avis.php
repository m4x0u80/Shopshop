<?php
declare (strict_types = 1);

namespace MyApp\Entity;

class Avis
{
    private ?int $id_avis = null;
    private string $label_avis;
    private Produit $id_produit;

    public function __construct(?int $id_avis, string $commentaires_avis, string $label_avis, Produit $id_produit)
    {
        $this->id = $id_avis;
        $this->label = $label_avis;
        $this->commentaires = $commentaires_avis;
        $this->produit = $id_produit;
    }
    public function getid_avis(): ?int
    {
        return $this->id_avis;
    }
    public function setid_avis(?int $id_avis): void
    {
        $this->id_avis = $id_avis;
    }
    public function getlabel_avis(): string
    {
        return $this->label_avis;
    }
    public function setlabel_avis(string $label_avis): void
    {
        $this->label_avis = $label_avis;
    }
    public function getid_produit(): ?int
    {
        return $this->id_produit;
    }
    public function setid_produit(?int $id_produit): void
    {
        $this->id_produit = $id_produit;
    }
}

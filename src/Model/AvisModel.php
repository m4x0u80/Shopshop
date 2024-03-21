<?php
declare (strict_types = 1);
namespace MyApp\Model;

use MyApp\Entity;
use PDO;

class AvisModel
{
    private PDO $db;
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }
    public function getAllAvis(): array
    {
        $sql = "SELECT * FROM Avis";
        $stmt = $this->db->query($sql);
        $avis = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $aviss[] = new Type($row['id_avis'], $row['label_avis'], $row['id_produit']);
        }
        return $aviss;
    }
}

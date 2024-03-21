<?php

declare (strict_types = 1);

namespace MyApp\Model;

use MyApp\Entity\Product;
use MyApp\Entity\Type;
use PDO;

class ProductModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllProduct(): array
    {
        $sql = "SELECT p.id as idProduct, image, name, description, price, stock, t.id as id_Type, name FROM Product p inner join Type t on p.id_Type = t.id order by name";
        $stmt = $this->db->query($sql);
        $produit = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $type = new Type($row['id_Type'], $row['name']);
            $produit[] = new Product($row['idProduct'], $row['image'], $row['name'], $row['description'], $row['price'], $row['stock'], $type);
        }

        return $produit;
    }

    public function getAllProductByType(Type $type): array
    {
        $sql = "SELECT p.id as id_Product, image, name, description, price, image, t.id as id_Type, label, stock FROM Product p INNER JOIN Type t ON p.id_Type = t.id LEFT JOIN Avis a ON p.id = a.id_produit WHERE p.id_Type = :type ORDER BY name";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':type', $type->getId(), PDO::PARAM_INT);
        $stmt->execute();
        $produits = [];

        while ($row = $stmt->fetch()) {
            $type = new Type($row['id_Type'], $row['label']);
            $produits[] = new Product($row['id_Product'], $row['image'], $row['name'], $row['description'], floatVal($row['price']), $row['stock'], $type);
        }

        return $produits;
    }

    public function createProduct(Product $produit): bool
    {
        $sql = "INSERT INTO Product (name, description, price, stock, id_Type) VALUES
(:name, :description, :price, :stock, :id_Type)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':name', $produit->getName(), PDO::PARAM_STR);
        $stmt->bindValue(':description', $produit->getDescription(), PDO::PARAM_STR);
        $stmt->bindValue(':price', $produit->getPrice(), PDO::PARAM_STR);
        $stmt->bindValue(':stock', $produit->getStock(), PDO::PARAM_INT);
        $stmt->bindValue(':id_Type', $produit->getType()->getId(), PDO::PARAM_INT);
        return $stmt->execute();
    }
}

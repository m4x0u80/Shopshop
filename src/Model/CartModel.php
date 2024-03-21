<?php

declare (strict_types = 1);

namespace MyApp\Model;

use MyApp\Entity\Product;
use MyApp\Entity\Type;
use MyApp\Entity\Cart;
use MyApp\Entity\User;
use PDO;

class CartModel
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getAllCarts(): array
    {
        $sql = "SELECT id_cart, creationDate, status, id_user FROM Cart c ";
        $stmt = $this->db->query($sql);
        $cart = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $cart[] = new Cart($row['id_cart'], $row['creationDate'], $row['status'], $row['id_user']);
        }

        return $cart;
    }

    public function createCart(Cart $cart): array 
    {
        $sql = "INSERT INTO Cart (id_cart, creationDate, status, id_user FROM Cart c) VALUES (:id_cart, :creationDate, :status, :id_user)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id_cart', $cart->getId_cart(), PDO::PARAM_STR);
        $stmt->bindValue(':creationDate', $cart->getcreationDate(), PDO::PARAM_STR);
        $stmt->bindValue(':status', $cart->getStatus(), PDO::PARAM_STR);
        $stmt->bindValue(':id_user', $cart->getUser()->getId(), PDO::PARAM_INT);
        
        return $stmt->execute();
    }
}
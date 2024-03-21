<?php
declare (strict_types = 1);

namespace MyApp\Entity;

class Cart {
    private ?int $id;
    private string $creationDate;
    private string $status;
    private User $user;

    public function __construct($id, $creationDate, $status, User $user) {
        $this->id = $id;
        $this->creationDate = $creationDate;
        $this->status = $status;
        $this->user = $user;
    }

    public function getId_cart(): ?int
    {
        return $this->id;
    }
    public function setId_cart(?int $id): void
    {
        $this->id = $id;
    }
    public function getcreationDate(): string
    {
        return $this->creationDate;
    }
    public function setcreationDate(date $creationDate): void
    {
        $this->creationDate = $creationDate;
    }
    public function getStatus(): string
    {
        return $this->status;
    }
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
    public function getUser(): User
    {
        return $this->user;
    }
    public function setUser(User $user): void
    {
        $this->user = $user;
    }

}
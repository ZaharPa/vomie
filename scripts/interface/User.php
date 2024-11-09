<?php
namespace scripts\interface;

interface User
{
    public function setName( $link, string $email): void;
    public function getName(): ?string;
    
    public function setId($link, string $email) : void;
    public function getId(): ?int;
    
    public function setRole($link, string $email): void;
    public function getRole(): ?string;
    
    public function loginUser($link, string $email, string $password): bool;
    public function regUser($link, string $email, string $password, string $name): bool;
    
    public function viewUser($link, int $id_user) : array;
    public function viewedMovieByUser($link, int $id_user) : array;
    
    public function countStatusMovie ($link, int $id_user, string $status) : ?int;
        
    public function updateName($link, int $id_user, string $newName) : bool;
    public function updatePass($link, int $id_user, string $newPass, string $oldPass) : bool;
    public function updatePhoto($link, int $id_user, string $path, string $photo) : bool;
}
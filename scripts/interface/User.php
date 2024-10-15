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
    
    public function changeProfilePhoto($link, string $email, string $path, string $photoName): bool;
    public function setNameImage($link, string $email): void;
    public function changeUserRole($link, string $email): bool;
    public function changeUserName($link, string $email) : bool;
    public function changeUserPassword($link, string $email) : bool;
    
    public function deleteUser($link, string $email) : bool;
}
<?php
namespace scripts\interface;

interface FeedBackInter
{
    public function addRate($link, int $id_movie, int $id_user, int $rate) : bool;
    public function editRate($link, int $id_movie, int $id_user, int $rate) : bool;

    public function addStatus($link, int $id_movie, int $id_user, string $status) : bool;
    public function editStatus($link, int $id_movie, int $id_user, string $status) : bool;
    
    public function IsStatus($link, int $id_movie, int $id_user): bool;
    
    public function deleteRateAndStatus($link, int $id_movie, int $id_user) : bool;
    
    public function viewRate($link, int $id_movie, int $id_user) : ?string;
    public function viewAverageRate($link, int $id_movie) : float;
    
    public function viewStatus($link, int $id_movie, $id_user) : ?string;
    public function viewComment($link, int $id_movie) : array;
    
    public function addComment($link, int $id_movie, int $id_user, string $comment, string $date) : bool;
    public function editComment($link, int $id_comment, string $comment) : bool;
    public function deleteComment($link, int $id_comment) : bool;
    
}


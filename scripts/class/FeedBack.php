<?php
namespace scripts\class;

use scripts\interface\FeedBackInter;

class FeedBack implements FeedBackInter
{
    public function addRate($link, $id_movie, $id_user, $rate) : bool
    {}
    
    public function editRate($link, $id_movie, $id_user, $rate) : bool
    {}

    public function addStatus($link, $id_movie, $id_user, $status) : bool
    {}

    public function editStatus($link, $id_movie, $id_user, $status) : bool
    {}
    
    public function deleteRateAndStatus($link, $id_movie, $id_user) : bool
    {} 
    
    public function viewRate($link, $id_movie, $id_user) : array
    {}
    
    public function viewAverageRate($link, $id_movie) : float
    {}
    
    public function viewStatus($link, $id_movie, $id_user) : array
    {   }
    
    public function viewComment($link, $id_movie) : array
    {}

    public function addComment($link, $id_movie, $id_user, $comment) : bool
    {}

    public function editComment($link, $id_comment, $comment) : bool
    {}
    
    public function deleteComment($link, $id_comment) : bool
    {}
}


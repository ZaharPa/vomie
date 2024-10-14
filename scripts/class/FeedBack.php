<?php
namespace scripts\class;

use scripts\interface\FeedBackInter;

class FeedBack implements FeedBackInter
{

    public function viewRate($link, $id_movie, $id_user)
    {}

    public function deleteComment($link, $id_comment)
    {}

    public function editRate($link, $id_movie, $id_user, $rate)
    {}

    public function addStatus($link, $id_movie, $id_user, $status)
    {}

    public function editComment($link, $id_comment, $comment)
    {}

    public function addRate($link, $id_movie, $id_user, $rate)
    {}

    public function editStatus($link, $id_movie, $id_user, $status)
    {}

    public function viewComment($link, $id_movie)
    {}

    public function deleteRateAndStatus($link, $id_movie, $id_user)
    {}

    public function addComment($link, $id_movie, $id_user, $comment)
    {}

    public function viewAverageRate($link, $id_movie)
    {}
}


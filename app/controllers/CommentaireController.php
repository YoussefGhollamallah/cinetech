<?php

namespace App\Controllers;

use App\Models\ModelCommentaire;

class commentaireController
{
    private $ModelCommentaire;

    public function __construct()
    {
        $this->ModelCommentaire = new ModelCommentaire();
    }

    public function addComment($id, $content, $id_user, $id_media)
    {
        $result = $this->ModelCommentaire->addComment($id, $content, $id_user, $id_media);
        return $result;
    }

    public function getComments($id, $type)
    {
        $result = $this->ModelCommentaire->getComments($id, $type);
        return $result;
    }

}
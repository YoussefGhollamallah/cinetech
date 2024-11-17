<?php

namespace App\Models;

use config\Connexion;

class ModelCommentaire
{
    private $connexion;

    public function __construct()
    {
        $conn = new Connexion();
        $this->connexion = $conn->connexionBDD();
        $this->connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function addComment($id, $content, $id_user, $id_media)
    {
        try {
            $query = "INSERT INTO commentaire (id_commentaire, content, id_media,  id_user, created_at) VALUES (null, ?, ?, ?, NOW())";
            $result = $this->connexion->prepare($query);
            $result->execute([$content, $id_media, $id_user]);
            return 'Commentaire ajouté';
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de l'ajout du commentaire : " . $e->getMessage());
        }
    }

    public function getComments($id, $type)
    {
        try {
            $query = "SELECT c.content, u.firstname, u.lastname, c.created_at 
                      FROM commentaire c 
                      JOIN user u ON c.id_user = u.id 
                      WHERE c.id_media = :id 
                      ORDER BY c.created_at DESC";
            $result = $this->connexion->prepare($query);
            $result->execute(['id' => $id]);
            return $result->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new \Exception("Erreur lors de la récupération des commentaires : " . $e->getMessage());
        }
    }

    
    
}
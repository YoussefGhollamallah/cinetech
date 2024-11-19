<?php

namespace App\Controllers;

use App\Models\ModelFavori;

class FavorisController
{

    private $ModelFavori;

    public function __construct()
    {
        $this->ModelFavori = new ModelFavori;
    }

    public function getAllFavorisByID($id)
    {
        $result = $this->ModelFavori->getAllFavoriByID($id);
        return $result;
    }

    public function deleteFavori($idFavori, $userId)
    {
        try {
            $deletedRows = $this->ModelFavori->deleteFavori($idFavori, $userId);
            if ($deletedRows > 0) {
                return ["success" => true, "message" => "Favori supprimé avec succès."];
            } else {
                return ["success" => false, "message" => "Aucun favori trouvé ou suppression non autorisée."];
            }
        } catch (\Exception $e) {
            return ["success" => false, "message" => $e->getMessage()];
        }
    }
}
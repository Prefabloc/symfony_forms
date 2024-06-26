<?php

namespace App\Service;

class ArticleDTO
{
    public $id;
    public $label;
    public $reference;
    public $societe;
    public $stock;
    public $abreviation;
    public function __construct($id, $label, $reference, $societe, $stock, $abreviation)
    {
        $this->id = $id;
        $this->label = $label;
        $this->reference = $reference;
        $this->societe = $societe;
        $this->stock = $stock;
        $this->abreviation = $abreviation;
    }

}
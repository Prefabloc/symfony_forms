<?php

namespace App\Service;

class ArticleDTO
{
    public $id ;
    public $label ;
    public $reference;
    public $societe;
    public $stock;
    public $canBeProduced ;

    public function __construct( $id , $label , $reference , $societe , $stock )
    {
        $this->id = $id ;
        $this->label = $label ;
        $this->reference = $reference ;
        $this->societe = $societe ;
        $this->stock = $stock ;
        $this->canBeProduced = true ;
    }

}
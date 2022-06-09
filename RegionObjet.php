<?php  
class Region
{
    private $_id = null;
    private $_nom = null;

    public function __construct($id, $nom)
    {
        $this->setId($id);
        $this->setNom($nom);
    }

    public function setId($id)
    {
        if(is_null($id)){
            return;
        }
        if (!is_numeric($id))
        {
            trigger_error('Id doit etre un entier');
            return;
        }
        $this->_id = (int)$id;
    }
    public function Id()
    {
        return $this->_id;
    }
    public function setNom($Nom)
    {
        if (is_null($Nom)) {
            return;
        }
        if (!is_string($Nom) || trim($Nom)=="") // S'il ne s'agit pas d'une string
        {
            trigger_error('Surname||Le prénom est obligatoire', E_USER_NOTICE);
            return;
        }
        $this->_nom = trim($Nom);
    }
    public function Nom()
    {
        return $this->_nom;
    }

}


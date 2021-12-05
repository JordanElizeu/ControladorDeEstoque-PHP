<?php

namespace DesafioBackend\Controller;

class AddCategory implements InterfaceControllerRequisition
{
    public function __construct()
    {
    }

    public function processRequisition()
    {
        require __DIR__ . '/../../view/addCategory.php';
    }
}
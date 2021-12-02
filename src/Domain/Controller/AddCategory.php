<?php

namespace DesafioBackend\Domain\Controller;

/** @version 0.1 */
class AddCategory implements InterfaceControllerRequisition
{

    public function __construct()
    {
        //ready to use builder when you need it
    }

    public function processRequisition()
    {
        require __DIR__ . '/../../../view/html/addCategory.php';
    }
}
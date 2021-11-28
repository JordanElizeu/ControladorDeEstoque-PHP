<?php

namespace DesafioBackend\Domain\Controller;

class AddProduct implements InterfaceControllerRequisition
{
    public function __construct()
    {
    }

    public function processRequisition()
    {
        $description = filter_input(
            INPUT_POST,
            'description',
            FILTER_SANITIZE_STRING
        );
        require __DIR__ . '/../../view/html/addProduct.php';
    }
}
<?php

namespace DesafioBackend\Domain\Controller;

class ListProduct implements InterfaceControllerRequisition
{
    public function __construct()
    {
    }

    public function processRequisition()
    {
        require __DIR__ . '/../../view/html/products.html';
    }
}
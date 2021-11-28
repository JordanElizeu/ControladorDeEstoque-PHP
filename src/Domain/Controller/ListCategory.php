<?php

namespace DesafioBackend\Domain\Controller;

class ListCategory implements InterfaceControllerRequisition
{
    public function __construct()
    {
    }

    public function processRequisition()
    {
        require __DIR__ . '/../../view/html/categories.html';
    }
}
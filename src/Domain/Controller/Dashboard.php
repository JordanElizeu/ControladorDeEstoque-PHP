<?php

namespace DesafioBackend\Domain\Controller;

class Dashboard implements InterfaceControllerRequisition
{
    public function __construct()
    {
    }

    public function processRequisition()
    {
        require __DIR__ . '/../../view/html/dashboard.html';
    }
}
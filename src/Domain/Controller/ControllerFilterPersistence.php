<?php

namespace DesafioBackend\Domain\Controller;

class ControllerFilterPersistence
{
    /**
     * @param string $value
     * @return string
     */
    //this method return text formatted removing all chars unwanted
    public function filterStringPolyfill(string $value): string
    {
        $str = preg_replace('/x00|<[^>]*>?/', '', $value);
        return str_replace(["'", '"'], ['&#39;', '&#34;'], $str);
    }
}
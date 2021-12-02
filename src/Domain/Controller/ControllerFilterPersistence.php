<?php

namespace DesafioBackend\Domain\Controller;

/** @version 0.3 */
class ControllerFilterPersistence
{
    /**
     * @param string $value
     * @return string
     * metodo de filtro evitando problemas de segurança
     * elimina caracteres que podem ocasionar um injection
     */
    //this method return text formatted removing all chars unwanted
    public function filterStringPolyfill(string $value): string
    {
        $str = preg_replace('/x00|<[^>]*>?/', '', $value);
        return str_replace(["'", '"'], ['&#39;', '&#34;'], $str);
    }
}
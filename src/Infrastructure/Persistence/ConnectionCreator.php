<?php

namespace DesafioBackend\Infrastructure\Persistence;

use PDO;

/** @version 0.1 */
class ConnectionCreator
{
    //this class create the connection of database and return self
    /** @return PDO
     * metodo usado para pegar conexão com o banco de dados
     */
    public static function createConnection() : PDO
    {
        $databasePath = __DIR__ . '/../../../banco.sqlite';

        $connection = new PDO('sqlite:' . $databasePath);
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        return $connection;
    }
}
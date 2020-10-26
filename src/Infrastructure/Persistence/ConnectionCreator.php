<?php

namespace Alura\Pdo\Infrastructure\Persistence;

use PDO;

class ConnectionCreator
{
    public static function createConnection(): PDO
    {
        $databasePath = __DIR__ . '/../../../banco.sqlite';

        // Definindo o local do banco/tipo
        $connection = new PDO('sqlite:' . $databasePath);
        // Definindo atributo de modo de erro (para lançar exceções)
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Definindo o padrão de fetch associativo (no qual as colunas do array tem o mesmo nome que do banco)
        $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        return $connection;
    }
}

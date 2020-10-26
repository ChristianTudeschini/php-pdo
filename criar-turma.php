<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;
use Alura\Pdo\Infrastructure\Repository\PdoStudentRepository;

require_once "vendor/autoload.php";

$connection = ConnectionCreator::createConnection();
$studentRepository = new PdoStudentRepository($connection);

try {
    // Processos de definição da turma
    // Com o beginTransaction, ele vai enviar a query pro banco mas não irá executar, vai guardar ela até o momento em que a transação for finalizada (ou seja, tudo estiver ok)
    $connection->beginTransaction();

    $aStudent = new Student(
        null, 
        'Carol', 
        new \DateTimeImmutable('2001-05-24')
    );
    $studentRepository->save($aStudent);

    $anotherStudent = new Student(
        null,
        'Chris',
        new \DateTimeImmutable('2002-05-27')
    );
    $studentRepository->save($anotherStudent);

    // Finalizando uma transação/executando a transação
    // Todos os saves que fizemos acimas vão ser realizados de fato só neste momento (devido à transação)
    $connection->commit();
} catch(\PDOException $err) {
    echo $err->getMessage();
    // RollBack faz com que as alterações não sejam executadas/finalizadas, ou seja, ele quebra a transação e desfaz todas as alterações que até então tinham sido estabelecidas
    $connection->rollBack();
}
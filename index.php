<?php

//print_r(PDO::getAvailableDrivers());

try {
    $db=new PDO('mysql:host=localhost; dbname=pdo-test', 'root', 'root');
    echo 'success';
} catch (PDOException $e) {
    print_r('Error!: ' .$e->getMessage());
    die();
};


// прямой запрос однострочный
/**
//$exec=$db->exec('insert into categories (name) value (\'Пылесосы\')'); //запись в БД

$res=$db->query('SELECT * from categories');
    //$row=$res->fetchAll();
    //     echo '<pre>';
    //    print_r ($row);
    //    echo '</pre>';
    // ИЛИ

while ($row=$res->fetch()) {
    echo '<pre>';
    print_r ($row);
    echo '</pre>';
};
*/

// Подготовленный запрос
/**
$id=3;
$stmt=$db->prepare('select name, id from categories'); //подготовленный запрос
$stmt->execute();
$category=$stmt->fetchAll(PDO::FETCH_KEY_PAIR);

echo '<pre>';
print_r($category);

echo '</pre>';
*/


/**
$limit=2; //ограничивает кол-во выводимых записей (первые 2 или ...)
$stm=$db->prepare('select *from categories limit ?');
$stm->bindValue(1, $limit, PDO::PARAM_INT);
$stm->execute();
$data=$stm->fetchAll();
echo '<pre>';
print_r($data);
echo '</pre>';
*/


/**
$arr =[1, 3, 6]; // выбор записей по id
$in = str_repeat('?,', count($arr)-1) . '?';
$stm =$db ->prepare("select * from categories where id in ($in)");
$stm ->execute($arr);
$data =$stm ->fetchAll();
echo '<pre>';
print_r($data);
echo '</pre>';
*/

/**
$name='новая категория'; //добавление записи
$stm=$db->prepare('insert into categories (name) values (:name)');
$stm->execute(['name'=>$name]);

echo '<pre>';
print_r($data);
echo '</pre>';
*/

/**
$id=3;
$name= 'Компьютеры'; // изменение записи
$stm=$db->prepare('update categories set name = :name where id =:id');
$stm->execute(['name'=>$name, 'id'=>$id]);
*/

/**
$id=12; // удаление записи
$stm=$db->prepare('delete from categories where id =:id');
$stm->execute(['id'=>$id]);
*/


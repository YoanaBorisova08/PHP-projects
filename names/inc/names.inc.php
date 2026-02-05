<?php
declare(strict_types=1);

function fetch_names_by_initial(string $char, int $page = 1, int $perPage = 15): array{
    global $pdo;
    $page = max(1, $page);

    $stmt = $pdo->prepare(
        'SELECT DISTINCT `name` FROM `names` 
        WHERE `name` LIKE :exp 
        ORDER BY `name` ASC
        LIMIT :limit
        OFFSET :offset');
    $stmt->bindValue(':exp', "{$char}%");
    $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $perPage*($page-1), PDO::PARAM_INT);
    $stmt->execute();
    $names = [];
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($results AS $r){
        $names[] = $r['name'];
    }
    return $names;
}

function count_names_by_inital($char){
    global $pdo;
    $stmt = $pdo->prepare(
        'SELECT COUNT(DISTINCT `name`) AS `count` FROM `names` 
        WHERE `name` LIKE :exp');
    $stmt->bindValue(':exp', "{$char}%");
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC)["count"];
}

function fetch_info_by_name(string $name): array{
    global $pdo;
    $stmt = $pdo->prepare(
        'SELECT * FROM names 
        WHERE `name`=:name 
        ORDER BY `year` ASC');
    $stmt->bindValue(':name', (string) $name);
    $stmt->execute();
    $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
    return $results;
}

function gen_names_overview(int $limit): array{
    global $pdo;
    $stmt=$pdo->prepare('SELECT `name`, SUM(`count`) AS `sum` 
    FROM `names` GROUP BY `name` 
    ORDER BY `sum` DESC 
    LIMIT :limit;');
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
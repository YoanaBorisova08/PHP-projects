<?php
namespace App\Repository;
use PDO;
use App\Model\PageModel;

class PagesRepository {

    public function __construct(private PDO $pdo){}

    public function fetchForNavigation(): array{
        return $this->get();
    }

    public function getSlugExists(string $slug){
        $stmt = $this->pdo->prepare('SELECT COUNT(*) 
        AS `count`
        FROM `pages` 
        WHERE `slug` = :slug');
        $stmt->bindValue(':slug', $slug);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($result['count'] >= 1);
    }

    public function create(string $title, string $slug, string $content): bool{
        if(!$this->getSlugExists($slug)){
            $stmt = $this->pdo->prepare('INSERT INTO `pages` (`title`, `slug`, `content`)
            VALUE(:title, :slug, :content)');
            $stmt->bindValue(':title', $title);
            $stmt->bindValue(':slug', $slug);
            $stmt->bindValue(':content', $content);
            return $stmt->execute();
        }
        return false;
    }

    public function edit(int $id, string $title, string $content){
        $stmt = $this->pdo->prepare('UPDATE `pages` 
        SET `title` := :title,
        `content` := :content
        WHERE `id` = :id
        ');
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function delete(int $id){
        $stmt = $this->pdo->prepare('DELETE FROM `pages` 
        WHERE `id` = :id
        ');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function get(): array{
        $stmt = $this->pdo->prepare('SELECT * FROM `pages` ORDER by `id` ASC');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, PageModel::class);
    }

    public function fetchBySlug(string $slug): ?PageModel{
        $stmt = $this->pdo->prepare('SELECT * FROM `pages` WHERE `slug` = :slug');
        $stmt->bindValue(':slug', $slug);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, PageModel::class);
        $entry = $stmt->fetch();
        if(empty($entry)) return null;
        return $entry;
    }

    public function fetchById(int $id): ?PageModel{
        $stmt = $this->pdo->prepare('SELECT * FROM `pages` WHERE `id` = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_CLASS, PageModel::class);
        $entry = $stmt->fetch();
        if(empty($entry)) return null;
        return $entry;
    }
}
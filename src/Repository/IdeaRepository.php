<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Idea;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Idea|null findOneBy(array $criteria, array $orderBy = null)
 * @method Idea[]    findAll()
 * @method Idea[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IdeaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Idea::class);
    }

    public function findByUserLogin(
        string $login,
        int    $limit,
        ?int   $offset = 0
    ): array {
        return $this->createQueryBuilder('idea')
            ->select([
                'idea.id        AS id',
                'idea.content   AS content',
            ])
            ->leftJoin('idea.author', 'author')
            ->where('author.login = :login')
            ->setParameter('login', $login)
            ->orderBy('idea.id', 'DESC')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult();
    }
}

<?php

namespace App\Repository;

use App\Entity\Post;
use App\Service\FileManagerServiceInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @method Post|null find($id, $lockMode = null, $lockVersion = null)
 * @method Post|null findOneBy(array $criteria, array $orderBy = null)
 * @method Post[]    findAll()
 * @method Post[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PostRepository extends ServiceEntityRepository implements PostRepositoryInterface
{
    private $entityManager;

    public function __construct(ManagerRegistry $registry, EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct($registry, Post::class);
    }

    public function getAll(): array
    {
        return parent::findAll();
    }

    public function getOne(int $postId): object
    {
        return parent::find($postId);
    }

    public function setCreate(Post $post): PostRepositoryInterface
    {
        $this->entityManager->persist($post);
        $this->entityManager->flush();

        return $this;
    }

    public function setSave(Post $post): PostRepositoryInterface
    {
        $this->entityManager->flush();

        return $this;
    }

    public function setDelete(Post $post)
    {
        $this->entityManager->remove($post);
        $this->entityManager->flush();
    }
}

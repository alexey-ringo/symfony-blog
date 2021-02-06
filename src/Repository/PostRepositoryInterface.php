<?php


namespace App\Repository;

use App\Entity\Post;

interface PostRepositoryInterface
{
    /**
     * @return Post[]
     */
    public function getAll(): array;

    /**
     * @param int $postId
     * @return Post
     */
    public function getOne(int $postId): object;

    /**
     * @param Post $post
     * @return $this
     */
    public function setCreate(Post $post): self;

    /**
     * @param Post $post
     * @return $this
     */
    public function setSave(Post $post): self;

    /**
     * @param Post $post
     */
    public function setDelete(Post $post);
}
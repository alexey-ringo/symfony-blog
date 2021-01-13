<?php


namespace App\Repository;

use App\Entity\Post;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface PostRepositoryInterface
{
    /**
     * @return Post[]
     */
    public function getAllPost(): array;

    /**
     * @param int $postId
     * @return Post
     */
    public function getOnePost(int $postId): object;

    /**
     * @param Post $post
     * @param UploadedFile|null $file
     * @return object
     */
    public function setCreatePost(Post $post, UploadedFile $file = null): object;

    /**
     * @param Post $post
     * @param UploadedFile|null $file
     * @return object
     */
    public function setUpdatePost(Post $post, UploadedFile $file = null): object;

    /**
     * @param Post $post
     */
    public function setDeletePost(Post $post);
}
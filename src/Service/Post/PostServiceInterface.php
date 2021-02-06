<?php


namespace App\Service\Post;

use App\Entity\Post;
use Symfony\Component\Form\FormInterface;

interface PostServiceInterface
{
    /**
     * @param FormInterface $form
     * @param Post $post
     * @return $this
     */
    public function handleCreate(FormInterface $form, Post $post): self;


    /**
     * @param FormInterface $form
     * @param $post
     * @return $this
     */
    public function handleUpdate(FormInterface $form,Post $post): self;


    /**
     * @param $post
     */
    public function handleDelete(Post $post);
}
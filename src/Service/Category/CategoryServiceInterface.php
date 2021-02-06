<?php


namespace App\Service\Category;


use App\Entity\Category;

interface CategoryServiceInterface
{
    /**
     * @param Category $category
     * @return $this
     */
    public function handleCreate(Category $category): self;

    /**
     * @param Category $category
     * @return $this
     */
    public function handleUpdate(Category $category): self;

    /**
     * @param Category $category
     */
    public function handleDelete(Category $category);
}

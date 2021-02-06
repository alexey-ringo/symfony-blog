<?php


namespace App\Repository;


use App\Entity\Category;

interface CategoryRepositoryInterface
{
    /**
     * @return Category[]
     */
    public function getAll(): array;

    /**
     * @param int $categoryId
     * @return Category
     */
    public function getOne(int $categoryId): object;

    /**
     * @param Category $category
     * @return $this
     */
    public function setCreate(Category $category): self;

    /**
     * @param Category $category
     * @return $this
     */
    public function setSave(Category $category): self;

    /**
     * @param Category $category
     */
    public function setDelete(Category $category);
}
<?php


namespace App\Service;


class CategoryService
{
    public function displayTitleCategories(array $categories): string
    {
        $result = "";
        foreach($categories as $category) {
            $result .= " - {$category->getTitle()}";
        }
        return $result;
    }

    public function displayImageCategories(array $categories): string
    {
        $result = "";
        foreach($categories as $category) {
            $result .= "{$category->getImage()}";
        }
        return $result;
    }

    public function evenCategories($categories): array
    {
        $result = [];
        foreach($categories as $category) {
            if($category->getId() % 2 === 0) {
                $result[] = $category->getTitle();
            }
        }
        return $result;
    }


}
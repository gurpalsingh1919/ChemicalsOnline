<?php

use App\Models\Category;

if (!function_exists('getAllCategoryIds')) {
    function getAllCategoryIds(Category $category)
    {
        $ids = [$category->id];

        foreach ($category->subcategories as $sub) {
            $ids = array_merge($ids, getAllCategoryIds($sub));
        }

        return $ids;
    }
}

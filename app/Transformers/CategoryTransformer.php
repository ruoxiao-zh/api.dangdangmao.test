<?php

namespace App\Transformers;

use App\Models\Category;
use League\Fractal\TransformerAbstract;

class CategoryTransformer extends TransformerAbstract
{
    public function transform(Category $category)
    {
        return [
            'id'                         => $category->id,
            'name'                       => $category->name,
            'order'                      => (int)$category->order,
            'created_at'                 => $category->created_at ? $category->created_at->toDateTimeString() : '',
            'updated_at'                 => $category->updated_at ? $category->updated_at->toDateTimeString() : '',
            'created_at_diff_for_humans' => $category->created_at_diff_for_humans,
        ];
    }
}

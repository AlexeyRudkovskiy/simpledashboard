<?php
/**
 * Created by PhpStorm.
 * User: alexey
 * Date: 26.08.18
 * Time: 04:32
 */

namespace ARudkovskiy\Admin\EntityFields;


use ARudkovskiy\Admin\Contracts\EntityField;
use ARudkovskiy\Admin\Models\Category;
use Illuminate\Http\Request;

class CategoriesField extends EntityField
{

    protected $template = '@admin::form.widget.categories';

    public function __construct()
    {
        $this
            ->setHandleAfterSave(true)
            ->setIsUpdatingManually(true);
    }

    public function renderEditable()
    {
        $categories = Category::all();
        $currentCategories = $this->getEntity()
            ->getObject()
            ->categories
            ->map(function (Category $category) {
                return $category->id;
            })
            ->toArray();

        return parent::renderEditable()
            ->with('categories', $categories)
            ->with('currentCategories', $currentCategories);
    }

    public function handleRequest(Request $request, $entityObject)
    {
        $categories = $request->get('categories');
        $entityObject->{$this->name}()->sync($categories, true);
    }

}
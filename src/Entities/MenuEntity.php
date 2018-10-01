<?php
/**
 * Created by PhpStorm.
 * User: alexey
 * Date: 08.08.18
 * Time: 00:15
 */

namespace ARudkovskiy\Admin\Entities;


use ARudkovskiy\Admin\Contracts\AbstractEntity;
use ARudkovskiy\Admin\EntityFields\AddMenuItemField;
use ARudkovskiy\Admin\EntityFields\CategoriesField;
use ARudkovskiy\Admin\EntityFields\IdField;
use ARudkovskiy\Admin\EntityFields\MenuField;
use ARudkovskiy\Admin\EntityFields\TextField;
use ARudkovskiy\Admin\Models\Menu;

class MenuEntity extends AbstractEntity
{

    protected $entityClass = Menu::class;

    public function registerFields(): array
    {
        return [
            IdField::create('id'),
            TextField::create('name')
                ->showInIndexTable()
                ->setOrderInIndexTable(1),
            MenuField::create('items')
                ->setOptions([
                    'id' => implode('_', [ 'menu', 'items', $this->getUniqueIdentifier() ])
                ]),
            CategoriesField::create('categories')
                ->setOptions([
                    'location' => 'sidebar'
                ]),
            TextField::create('location')
                ->setOptions([ 'location' => 'sidebar' ]),
            TextField::create('tag')
                ->setOptions([ 'location' => 'sidebar' ])
        ];
    }

    public function getTranslations(): array
    {
        return trans('@admin::dashboard.entity.menu');
    }

    public function getIcon(): string
    {
        return 'fa fa-link';
    }

    public function validateRequest(string $type): bool
    {
        return true;
    }

    public function getSection(): string
    {
        return 'system';
    }

}
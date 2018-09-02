<?php
/**
 * Created by PhpStorm.
 * User: alexey
 * Date: 07.08.18
 * Time: 23:45
 */

namespace ARudkovskiy\Admin\EntityFields;


use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;

class SlugField extends TextField
{

    public function handleRequest(Request $request, $entityObject)
    {
        $originalFieldName = $this->getOption('config.field');
        $originalValue = $request->get($originalFieldName);
        $slugify = new Slugify($this->getOption('config'));
        $this->value = $slugify->slugify($originalValue);
    }

    public function getDefaultOptions(): array
    {
        return array_merge(parent::getDefaultOptions(), [
            'config' => [
                'trim' => true,
                'separator' => true,
                'lowercase' => true
            ]
        ]);
    }


}
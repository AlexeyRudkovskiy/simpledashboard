<?php
/**
 * Created by PhpStorm.
 * User: alexey
 * Date: 25.07.18
 * Time: 18:28
 */

namespace ARudkovskiy\Admin\EntityFields;


use ARudkovskiy\Admin\Contracts\EntityField;
use Illuminate\Http\Request;

class WYSIWYGField extends EntityField
{

    protected $template = '@admin::form.widget.wysiwyg';

    public function handleRequest(Request $request, $entityObject)
    {
        $updatedValue = $request->get($this->name);
        $matches = null;
        preg_match_all('/( ?)style=\"(([a-zA-Z0-9\;\:\ ]+)| ?)\"/im', $updatedValue, $matches);
        $matches = array_unique($matches[0]);
        foreach ($matches as $match) {
            $updatedValue = str_replace($match, '', $updatedValue);
        }
        $this->value = $updatedValue;
    }


}
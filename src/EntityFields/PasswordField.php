<?php
/**
 * Created by PhpStorm.
 * User: alexey
 * Date: 04.08.18
 * Time: 21:03
 */

namespace ARudkovskiy\Admin\EntityFields;


use Illuminate\Http\Request;

class PasswordField extends TextField
{

    protected $type = 'password';

    public function __construct()
    {
        parent::__construct();
        $this->setIsUpdatingManually(true);
    }

    public function handleRequest(Request $request, $entityObject)
    {
        if ($request->get('password', null) === null) {
            return;
        }
        parent::handleRequest($request, $entityObject);
        $entityObject->{$this->name} = $this->value;
    }


}
<?php
namespace Hirotae\Resource\Page;

use Ray\WebFormModule\AbstractForm;
use Ray\WebFormModule\SetAntiCsrfTrait;

class MyForm extends AbstractForm
{
    public function init()
    {
        $this->setField('name', 'text')
            ->setAttribs([
                'id' => 'name'
            ]);

        $this->
    }
}
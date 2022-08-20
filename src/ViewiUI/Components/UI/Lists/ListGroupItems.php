<?php

namespace ViewiUI\Components\UI\Lists;

use Viewi\BaseComponent;

class ListGroupItems extends BaseComponent
{
    public bool $modelValue = false;

    public function getStyle()
    {
        return $this->modelValue ? null : 'display:none;';
    }
}

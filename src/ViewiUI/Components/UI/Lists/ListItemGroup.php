<?php

namespace ViewiUI\Components\UI\Lists;

use Viewi\BaseComponent;

class ListItemGroup extends BaseComponent
{
    public ?string $color = null;
    public ?string $class = null;

    public function getClasses()
    {
        return "item-group theme-light list-item-group"
            . ($this->color != null ? ' ' . $this->color . '-text' : '')
            . ($this->class != null ? ' ' . $this->class : '');
    }
}

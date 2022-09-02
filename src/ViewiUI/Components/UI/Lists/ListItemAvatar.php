<?php

namespace ViewiUI\Components\UI\Lists;

use Viewi\BaseComponent;

class ListItemAvatar extends BaseComponent
{
    public ?string $class = null;

    public function getClasses()
    {
        return "viewi-avatar list-item-avatar"
            . ($this->class != null ? ' ' . $this->class : '');
    }
}

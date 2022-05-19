<?php

namespace ViewiUI\Components\UI\Grid;

use Viewi\BaseComponent;

class Container extends BaseComponent
{
    public bool $fluid = false;
    public string $tag = 'div';
    public ?string $id = null;
    public ?string $class = null;

    function getClasses()
    {
        $classes = 'container';
        $classes .= $this->fluid ? ' fluid' : '';
        $classes .= $this->class ? ' ' . $this->class : '';
        return $classes;
    }
}

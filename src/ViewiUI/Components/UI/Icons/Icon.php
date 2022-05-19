<?php

namespace ViewiUI\Components\UI\Icons;

use Viewi\BaseComponent;
use Viewi\DOM\Events\DOMEvent;

class Icon extends BaseComponent
{
    public ?string $color = null;
    public string $name;
    public string $tag = 'i';
    /**
     * 
     * @var '' | 'xsmall' | 'small' | 'large' | 'xlarge'
     */
    public string $size = '';
    public ?string $position = null;

    function getClasses()
    {
        $classes = 'viewi-icon mdi ' . $this->name;
        if ($this->color) {
            $classes .= ' ' . $this->color . '-text';
        }
        $classes .= $this->size ? ' size-' . $this->size : '';
        $classes .= $this->position ? ' pos-' . $this->position : '';
        return $classes;
    }

    function onClick(DOMEvent $event)
    {
        $this->emitEvent('click', $event);
    }
}

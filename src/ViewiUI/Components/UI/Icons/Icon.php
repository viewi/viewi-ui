<?php

namespace ViewiUI\Components\UI\Icons;

use Viewi\BaseComponent;
use Viewi\DOM\Events\DOMEvent;

class Icon extends BaseComponent
{
    public ?string $color = null;
    public string $name;
    public string $tag = 'i';
    public bool $dense = false;
    public bool $disabled = false;
    /**
     * 
     * @var '' | 'xsmall' | 'small' | 'large' | 'xlarge'
     */
    public string $size = '';
    public ?string $position = null;

    function __mounted()
    {
        $this->tag = $this->clickable() ? 'button' : $this->tag;
    }

    function getClasses()
    {
        $classes = 'viewi-icon mdi ' . $this->name;
        if ($this->color) {
            $classes .= ' ' . $this->color . '-text';
        }
        $classes .= $this->size ? ' size-' . $this->size : '';
        $classes .= $this->position ? ' pos-' . $this->position : '';
        $classes .= $this->dense ? ' viewi-icon-dense' : '';
        $classes .= $this->disabled ? ' viewi-icon-disabled' : '';
        $classes .= $this->clickable() ? ' viewi-icon-link' : '';
        return $classes;
    }

    function clickable(): bool
    {
        return isset($this->_props['(click)']);
    }

    function onClick(DOMEvent $event)
    {
        $this->emitEvent('click', $event);
    }
}

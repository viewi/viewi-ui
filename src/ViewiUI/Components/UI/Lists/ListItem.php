<?php

namespace ViewiUI\Components\UI\Lists;

use Viewi\BaseComponent;

class ListItem extends BaseComponent
{
    public bool $link = false;
    public ?bool $expanded = null;
    public bool $active = false;
    public bool $groupHeader = false;
    public ?string $color = null;
    public ?string $class = null;
    public ?string $href = null;
    public ?string $target = null;
    public ?string $rel = null;

    public function getTag()
    {
        return $this->href !== null ? 'a' : 'div';
    }

    public function getClasses()
    {
        return "list-item theme-light "
            . ($this->color != null && ($this->expanded || $this->active) ? ' ' . $this->color : '')
            . ($this->class != null ? ' ' . $this->class : '');
    }

    public function onClick($event)
    {
        $this->emitEvent('click', $event);
    }
}

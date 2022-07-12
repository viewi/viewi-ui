<?php

namespace ViewiUI\Components\UI\Forms;

use Viewi\BaseComponent;
use Viewi\DOM\Events\DOMEvent;

class TextField extends BaseComponent
{
    public string $value = '';
    public ?string $id = null;
    public string $label = '';
    public ?string $placeholder = null;
    public bool $isFocused = false;
    public bool $solo = false;
    public bool $filled = false;
    public bool $outlined = false;

    function getId(): string
    {
        return $this->id ?? "input-{$this->__id}";
    }

    function isEnclosed()
    {
        return $this->solo || $this->filled || $this->outlined;
    }

    function onFocus($event)
    {
        $this->isFocused = true;
        $this->emitEvent('focus', $event);
    }

    function onBlur($event)
    {
        $this->isFocused = false;
        $this->emitEvent('blur', $event);
    }
}

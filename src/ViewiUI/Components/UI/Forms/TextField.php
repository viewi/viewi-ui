<?php

namespace ViewiUI\Components\UI\Forms;

use Viewi\BaseComponent;
use Viewi\DOM\Events\DOMEvent;

class TextField extends BaseComponent
{
    public string $value = '';
    public ?string $uid = null;
    public ?string $id = null;
    public string $label = '';
    public ?string $placeholder = null;
    public bool $isFocused = false;
    public bool $solo = false;
    public bool $filled = false;
    public bool $outlined = false;
    public bool $booted = false;
    public bool $hasValue = false;

    function __mounted()
    {
        $this->booted = true;
        $this->uid = $this->__id;
    }

    function getId(): string
    {
        return $this->id ?? "input-{$this->uid}";
    }

    function getClasses(): string
    {
        $classes = 'viewi-input text-field';
        $classes .= $this->solo ? ' text-field-solo' : '';
        $classes .= $this->isEnclosed() ? ' text-field-enclosed' : '';
        $classes .= $this->filled ? ' text-field-filled' : '';
        $classes .= $this->outlined ? ' text-field-outlined' : '';
        return $classes;
    }

    function isEnclosed()
    {
        return $this->solo || $this->filled || $this->outlined;
    }

    function onClick($event)
    {
        $this->emitEvent('click', $event);
        $this->_refs['input']->focus();
    }

    function onInput(DOMEvent $event)
    {
        $this->hasValue = !!$event->target->value;
        $this->emitEvent('input', $event);
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

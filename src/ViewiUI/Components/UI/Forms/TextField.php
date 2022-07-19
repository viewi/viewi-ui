<?php

namespace ViewiUI\Components\UI\Forms;

use Viewi\BaseComponent;
use Viewi\Components\Services\ClientTimer;
use Viewi\DOM\Events\DOMEvent;

class TextField extends BaseComponent
{
    public ?string $value = null;
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
    public ?string $hint = null;
    public bool $persistentHint = false;
    public bool $clearable = false;
    public array $messages = [];
    public ?int $counter = null;
    /**
     * 
     * @var callable
     */
    public $counterValue = null;
    /**
     * 
     * @var null|callable[]
     */
    public ?array $rules = null;
    public array $validationMessages = [];
    public bool $hasValidationMessages = false;

    function __mounted()
    {
        $this->booted = true;
        $this->uid = $this->__id;
        $this->hasValue = !!$this->value;
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

    function isEnclosed(): bool
    {
        return $this->solo || $this->filled || $this->outlined;
    }

    function hasHint(): bool
    {
        return !$this->hasValidationMessages &&
            !!$this->hint &&
            ($this->persistentHint || $this->isFocused);
    }

    function getMessages(): array
    {
        if ($this->hasHint()) {
            return [$this->hint];
        }
        if ($this->hasValidationMessages) {
            return $this->validationMessages;
        }
        return [];
    }

    function hasMessages(): bool
    {
        return count($this->getMessages()) > 0;
    }

    function getCurrentCount(): int
    {
        return $this->counterValue ? ($this->counterValue)($this->value) : strlen($this->value ?? '');
    }

    function validate()
    {
        $this->validationMessages = [];
        $this->hasValidationMessages = false;
        foreach ($this->rules as $validationRule) {
            $validationResult = $validationRule($this->value);
            if ($validationResult === true) {
                continue;
            }
            $this->validationMessages[] = $validationResult === false ? 'Validation has failed' : $validationResult;
            $this->hasValidationMessages = true;
        }
    }

    function postValidate()
    {
        ClientTimer::setTimeoutStatic($this->validate, 0);
    }

    // EVENTS
    function onKeyDown(DOMEvent $event)
    {
        $this->emitEvent('keydown', $event);
        $this->postValidate();
    }

    function onMouseDown(DOMEvent $event)
    {
        if ($event->target !== $this->_refs['input']) {
            $event->preventDefault();
            $event->stopPropagation();
        }
        $this->emitEvent('mousedown', $event);
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
        $this->postValidate();
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
        $this->postValidate();
    }

    function onClearClick($event)
    {
        $this->_refs['input']->focus();
        $this->value = null;
        $this->hasValue = false;
        $this->postValidate();
    }
}

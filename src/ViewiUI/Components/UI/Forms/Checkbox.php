<?php

namespace ViewiUI\Components\UI\Forms;

use Viewi\BaseComponent;
use Viewi\Components\Services\ClientTimer;
use Viewi\DOM\Events\DOMEvent;

class Checkbox extends BaseComponent
{
    public ?string $value = null;
    public $modelValue = null;
    public bool $checked = false;
    public ?string $uid = null;
    public ?string $id = null;
    public string $label = '';
    public string $color = 'primary';
    public string $type = 'checkbox';
    public bool $dense = false;
    public bool $disabled = false;
    public bool $readonly = false;
    /**
     * 
     * @var bool|'auto'
     */
    public $hideDetails = false;
    public bool $hasValue = false;
    public array $messages = [];
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
        if ($this->checked) {
            $this->modelValue = true;
        }
    }

    function getId(): string
    {
        return $this->id ?? "input-{$this->uid}";
    }

    function getClasses(): string
    {
        $classes = 'viewi-input input-checkbox input-selection-controls';
        $classes .= $this->dense ? ' input-dense' : '';
        $classes .= $this->disabled ? ' input-is-disabled' : '';
        return $classes;
    }

    function isChecked(): bool
    {
        return is_array($this->modelValue)
            ? in_array($this->value, $this->modelValue)
            : ($this->modelValue ?? false);
    }

    function showDetails(): bool
    {
        if ($this->hideDetails === 'auto') {
            return $this->hasMessages();
        }
        return !$this->hideDetails;
    }

    function getMessages(): array
    {
        if ($this->hasValidationMessages) {
            return $this->validationMessages;
        }
        return [];
    }

    function hasMessages(): bool
    {
        return count($this->getMessages()) > 0;
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
    function prevent(DOMEvent $event)
    {
        $event->stopPropagation();
        $event->preventDefault();
    }

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
        if ($event->target !== $this->_refs['input']) {
            $event->preventDefault();
            $event->stopPropagation();
            $this->_refs['input']->click();
            return;
        }
        $this->emitEvent('click', $event);
    }

    function onChange(DOMEvent $event)
    {
        $this->checked = $event->target->checked;
        $this->emitEvent('change', $event);
        $this->postValidate();
    }
}

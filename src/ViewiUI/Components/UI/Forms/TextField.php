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
    public ?string $autocomplete = null;
    public string $type = 'text';
    public ?string $placeholder = null;
    public bool $isFocused = false;
    public bool $solo = false;
    public bool $filled = false;
    public bool $outlined = false;
    public bool $booted = false;
    public bool $dense = false;
    public bool $rounded = false;
    public bool $shaped = false;
    public bool $disabled = false;
    public bool $readonly = false;
    /**
     * 
     * @var bool|'auto'
     */
    public $hideDetails = false;
    public bool $hasValue = false;
    public ?string $hint = null;
    public bool $persistentHint = false;
    public bool $clearable = false;
    public array $messages = [];
    /**
     * 
     * @var null|int|true
     */
    public $counter = null;
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
    public ?string $prependIcon = null;
    public ?string $prependInnerIcon = null;
    public ?string $appendIcon = null;
    public ?string $appendOuterIcon = null;
    public ?string $prefix = null;
    public ?string $suffix = null;
    public bool $singleLine = false;
    public bool $fullWidth = false;
    // textarea
    public bool $textarea = false;
    public int $rows = 5;
    public bool $noResize = false;
    public bool $autoGrow = false;
    public float $rowHeight = 28;
    // select
    public bool $select = false;
    public ?array $items = null;

    function __mounted()
    {
        $this->booted = true;
        $this->uid = $this->__id;
        $this->hasValue = !!$this->value;
    }

    function __rendered()
    {
        $this->hasValue = !!$this->value;
        if ($this->autoGrow) {
            $this->calculateInputHeight();
        }
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
        $classes .= $this->isSingle() ? ' text-field-single-line' : '';
        $classes .= $this->filled ? ' text-field-filled' : '';
        $classes .= $this->outlined ? ' text-field-outlined' : '';
        $classes .= $this->dense ? ' input-dense' : '';
        $classes .= $this->rounded ? ' text-field-rounded' : '';
        $classes .= $this->shaped ? ' text-field-shaped' : '';
        $classes .= $this->prependInnerIcon ? ' field-has-prepend' : '';
        $classes .= $this->textarea ? ' viewi-textarea' : '';
        $classes .= $this->noResize ? ' textarea-no-resize' : '';
        $classes .= $this->autoGrow ? ' textarea-auto-grow' : '';
        $classes .= $this->autoGrow || $this->noResize ? ' textarea-no-resize' : '';
        return $classes;
    }

    function isEnclosed(): bool
    {
        return $this->solo || $this->filled || $this->outlined;
    }

    function isSingle(): bool
    {
        return ($this->solo ||
            $this->singleLine ||
            $this->fullWidth ||
            ($this->filled && $this->label === '')
        );
    }

    function showDetails(): bool
    {
        if ($this->hideDetails === 'auto') {
            return $this->hasMessages();
        }
        return !$this->hideDetails;
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

    // textarea

    function calculateInputHeight()
    {
        $input = $this->_refs['input'] ?? false;
        if (!$input) return;

        $input->style->height = '0';
        $height = $input->scrollHeight;
        $minHeight = intval($this->rows, 10) * floatval($this->rowHeight);
        $input->style->height = max($minHeight, $height) . 'px';
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
        if ($this->autoGrow)
            $this->calculateInputHeight();
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

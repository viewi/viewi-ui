<?php

namespace ViewiUI\Components\UI\Buttons;

use Viewi\BaseComponent;
use Viewi\DOM\Events\DOMEvent;

class Button extends BaseComponent
{
    public string $tag = 'button';
    public bool $block = false;
    public bool $disabled = false;
    public ?int $elevation = null;
    public ?string $color = null;
    public bool $outlined = false;
    public bool $plain = false;
    public bool $text = false;
    public bool $tile = false;
    public bool $rounded = false;
    public bool $pill = false;
    public bool $absolute = false;
    public bool $fixed = false;
    public bool $top = false;
    public bool $bottom = false;
    public bool $right = false;
    public bool $left = false;
    public bool $depressed = false;
    /**
     * 
     * @var '' | 'xsmall' | 'small' | 'large' | 'xlarge'
     */
    public string $size = '';
    public bool $icon = false;
    public ?string $href = null;
    public ?string $target = null;
    public ?string $type = 'button';
    public bool $loading = false;

    function __mounted()
    {
        $this->tag = $this->href !== null ? 'a' : $this->tag;
    }

    function getClasses()
    {
        $isElevated = $this->getIsElevated();
        // TODO: shakeTree="true" with source code scan
        // TODO: scss
        $classes = 'viewi-button';
        $classes .= $this->block ? ' block' : '';
        $classes .= $this->disabled ? ' disabled' : '';
        $classes .= $isElevated ? ' elevation-default' : '';
        $classes .= $this->hasBackground() ? ' has-background' : '';
        $classes .= $this->elevation !== null && $isElevated ? ' elevation-' . $this->elevation : '';
        if ($this->color && !$this->disabled) {
            $classes .= ' ' . $this->color . ($this->outlined || $this->plain || $this->text || $this->icon ? '-text' : '');
        }
        $classes .= $this->outlined ? ' outlined' : '';
        $classes .= $this->plain ? ' plain' : '';
        $classes .= $this->text ? ' text' : '';
        $classes .= $this->tile ? ' tile' : '';
        $classes .= $this->rounded ? ' rounded' : '';
        $classes .= $this->pill || $this->icon ? ' pill round' : '';
        $classes .= $this->size ? ' size-' . $this->size : ' size-default';
        $classes .= $this->absolute ? ' viewi-button-absolute' : '';
        $classes .= $this->fixed ? ' viewi-button-fixed' : '';
        $classes .= $this->right ? ' pos-right' : '';
        $classes .= $this->left ? ' pos-left' : '';
        $classes .= $this->top ? ' pos-top' : '';
        $classes .= $this->bottom ? ' pos-bottom' : '';
        $classes .= $this->icon ? ' icon' : '';
        $classes .= $this->loading ? ' button-loading' : '';
        return $classes;
    }

    function hasBackground(): bool
    {
        return !$this->text && !$this->plain && !$this->outlined && !$this->icon;
    }

    function getIsElevated(): bool
    {
        return !$this->icon &&
            !$this->text &&
            !$this->outlined &&
            !$this->depressed &&
            !$this->disabled &&
            !$this->plain &&
            ($this->elevation === null || $this->elevation > 0);
    }

    function onClick(DOMEvent $event)
    {
        $this->emitEvent('click', $event);
    }
}

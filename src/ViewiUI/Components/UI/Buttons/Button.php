<?php

namespace ViewiUI\Components\UI\Buttons;

use Viewi\BaseComponent;
use Viewi\DOM\Events\DOMEvent;

class Button extends BaseComponent
{
    public string $tag = 'button';
    public bool $block = false;
    public bool $disabled = false;
    /**
     * @options [null, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12,
     *           13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24]
     * @var null|int
     */
    public ?int $elevation = null;
    /**
     * @options [NULL, 'dark', 'light', 'success', 'error', 'primary', 'secondary', 'accent', 'warning', 'tertiary', 'info']
     * @var NULL | 'dark' | 'light' | 'success' | 'error'
     */
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
     * @options ['', 'xsmall', 'small', 'large', 'xlarge']
     * @var '' | 'xsmall' | 'small' | 'large' | 'xlarge'
     */
    public string $size = '';
    public bool $icon = false;
    public ?string $href = null;
    public ?string $target = null;
    public ?string $type = 'button';
    /**
     * @options [true, false]
     * @var bool
     */
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
        $classes .= isset($this->_props['class']) ? ' ' . $this->_props['class'] : '';
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
        // TODO: !retainFocusOnClick
        if (!$this->pill && $event->detail) {
            $this->_element->blur();
        }
        $this->emitEvent('click', $event);
    }
}

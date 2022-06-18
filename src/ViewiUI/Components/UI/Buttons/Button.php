<?php

namespace ViewiUI\Components\UI\Buttons;

use Viewi\BaseComponent;
use Viewi\DOM\Events\DOMEvent;

class Button extends BaseComponent
{
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
    /**
     * 
     * @var '' | 'xsmall' | 'small' | 'large' | 'xlarge'
     */
    public string $size = '';

    function getClasses()
    {
        // TODO: shakeTree="true" with source code scan
        // TODO: scss
        $classes = 'viewi-button';
        $classes .= $this->block ? ' block' : '';
        $classes .= $this->disabled ? ' disabled' : '';
        $classes .= $this->elevation !== null ? ' elevation-' . $this->elevation : '';
        if ($this->color) {
            $classes .= ' ' . $this->color . ($this->outlined || $this->plain || $this->text ? '-text' : '');
        }
        $classes .= $this->outlined ? ' outlined' : '';
        $classes .= $this->plain ? ' plain' : '';
        $classes .= $this->text ? ' text' : '';
        $classes .= $this->tile ? ' tile' : '';
        $classes .= $this->rounded ? ' rounded' : '';
        $classes .= $this->pill ? ' pill round' : '';
        $classes .= $this->size ? ' size-' . $this->size : ' size-default';

        return $classes;
    }

    function onClick(DOMEvent $event)
    {
        $this->emitEvent('click', $event);
    }
}

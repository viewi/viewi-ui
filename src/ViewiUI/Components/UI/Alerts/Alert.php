<?php

namespace ViewiUI\Components\UI\Alerts;

use Viewi\BaseComponent;
use Viewi\DOM\Events\DOMEvent;

class Alert extends BaseComponent
{
    /**
     * @options [null, 'top' | 'right' | 'bottom' | 'left']
     * @var 'top' | 'right' | 'bottom' | 'left'
     */
    public ?string $border = null;
    public bool $dense = false;
    public bool $prominent = false;
    public bool $outlined = false;
    public bool $text = false;
    public ?string $type = null;

    /**
     * @options [null, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12,
     *           13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24]
     * @var null|int
     */
    public ?int $elevation = null;
    public bool $rounded = false; // TODO
    public bool $shaped = false;
    public bool $tile = false;
    /**
     * 
     * @var ?string | false
     */
    public $icon = null;

    function getClasses()
    {
        $classes = 'viewi-alert viewi-sheet';
        $classes .= $this->dense ? ' alert-dense' : '';
        $classes .= $this->outlined ? ' alert-outlined' : '';
        $classes .= $this->prominent ? ' alert-prominent' : '';
        $classes .= $this->text ? ' alert-text' : '';
        $classes .= ' ' . $this->type . ($this->outlined || $this->text ? '-text' : '');
        $classes .= $this->elevation > 0 ? ' elevation-' . $this->elevation : '';
        $classes .= $this->shaped ? ' sheet-shaped' : '';
        $classes .= $this->tile ? ' sheet-tile' : '';
        $classes .= $this->border !== null ? ' alert-bordered alert-bordered-' . $this->border : '';
        return $classes;
    }

    function getBorderClasses(): ?string
    {
        if ($this->hasBorder()) {
            return $this->border ? ' alert-border alert-border-' . $this->border : '';
        }
        return null;
    }

    function hasBorder(): bool
    {
        return $this->border !== null;
    }

    function hasIcon(): bool
    {
        return $this->getIcon() !== null;
    }

    function getIcon(): ?string
    {
        if ($this->icon !== null && $this->icon !== false) {
            return $this->icon;
        }
        switch ($this->type) { // TODO: configurable icons per font, TODO: icons by selected font, TODO: include css
            case 'success':
                return 'mdi-checkbox-marked-circle';
            case 'info':
                return 'mdi-information-outline';
            case 'warning':
                return 'mdi-alert-outline';
            case 'error':
                return 'mdi-alert-octagon-outline';
            default:
                return null;
        }
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

<?php

namespace ViewiUI\Components\UI\Alerts;

use Viewi\BaseComponent;

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
    public bool $dismissible = false;
    public bool $active = true;
    public bool $coloredBorder = false;

    function getClasses()
    {
        $classes = 'viewi-alert viewi-sheet';
        $classes .= $this->dense ? ' alert-dense' : '';
        $classes .= $this->outlined ? ' alert-outlined' : '';
        $classes .= $this->prominent ? ' alert-prominent' : '';
        $classes .= $this->text ? ' alert-text' : '';
        $classes .= (!$this->coloredBorder || !$this->hasBorder()) && $this->type ? ' ' . $this->type . ($this->outlined || $this->text ? '-text' : '') : '';
        $classes .= $this->elevation > 0 ? ' elevation-' . $this->elevation : '';
        $classes .= $this->shaped ? ' sheet-shaped' : '';
        $classes .= $this->tile ? ' sheet-tile' : '';
        $classes .= $this->border !== null ? ' alert-bordered alert-bordered-' . $this->border : '';
        return $classes;
    }

    function getBorderClasses(): ?string
    {
        if ($this->hasBorder()) {
            return 'alert-border alert-border-' . $this->border
                . ($this->coloredBorder ? ' alert-border-has-color'
                    . ($this->type ? ' ' . $this->type : '')
                    : '');
        }
        return null;
    }

    function getIconClasses(): ?string
    {
        return 'alert-icon' . ($this->coloredBorder && $this->type ? ' ' . $this->type . '-text' : '');
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
        if ($this->icon !== null) {
            return $this->icon !== false ? $this->icon : null;
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

    function getIconColor(): ?string
    {
        return $this->outlined || $this->text || $this->coloredBorder ? $this->type : 'dark';
    }

    function onDismiss()
    {
        $this->active = !$this->active;
        $this->emitEvent('onDismiss', $this->active);
    }
}

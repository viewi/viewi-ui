<?php

namespace ViewiUI\Components\UI\Bars;

use Viewi\BaseComponent;
use Viewi\Components\Services\DomHelper;
use Viewi\DOM\Events\DOMEvent;

class Toolbar extends BaseComponent
{
    /** Sheet */
    public bool $outlined = false;
    public bool $shaped = false;
    /**
     * @options [null, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12,
     *           13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24]
     * @var null|int
     */
    public ?int $elevation = null;
    /**
     * 
     * @var bool|string
     */
    public $rounded = false;
    public bool $tile = false;
    public bool $dark = false;
    /** Toolbar */
    public bool $absolute = false;
    public bool $bottom = false;
    public bool $collapse = false;
    public bool $isCollapsed = false;
    public bool $dense = false;
    public bool $extended = false;
    public bool $flat = false;
    public bool $floating = false;
    public bool $prominent = false;
    public ?string $color = null;
    public ?string $contentClass = null;

    private function roundedClasses()
    {
        if ($this->rounded) {
            if ($this->rounded === true) {
                return ' rounded';
            }
            $parts = explode(' ', $this->rounded);
            $classes = '';
            foreach ($parts as $part) {
                $classes .= ' rounded-' . $part;
            }
            return $classes;
        }
        return '';
    }

    public function getClasses()
    {
        return 'viewi-sheet'
            . ($this->outlined ? ' sheet-outlined' : '')
            . ($this->shaped ? ' sheet-shaped' : '')
            . ($this->elevation !== null ? ' sheet-elevated elevation-' . $this->elevation : '')
            . $this->roundedClasses()
            . ($this->dark ? ' theme-dark' : ' theme-light')
            . (isset($this->_props['class']) ? ' ' . $this->_props['class'] : '')
            // themes
            // toolbar
            . ' viewi-toolbar'
            . ($this->absolute ? ' toolbar-absolute' : '')
            . ($this->bottom ? ' toolbar-bottom' : '')
            . ($this->collapse ? ' toolbar-collapse toolbar-collapsed' : '')
            // . ($this->isCollapsed ? ' toolbar-collapsed' : '')
            . ($this->dense ? ' toolbar-dense' : '')
            . ($this->extended ? ' toolbar-extended' : '')
            . ($this->flat ? ' toolbar-flat' : '')
            . ($this->floating ? ' toolbar-floating' : '')
            . ($this->prominent ? ' toolbar-prominent' : '')
            . ($this->color != null ? ' ' . $this->color : '');
    }

    function getContentClasses()
    {
        return 'toolbar-content'
            . ($this->contentClass !== null ? ' ' . $this->contentClass : '');
    }

    public function getWrapperHeight()
    {
        if ($this->prominent) {
            if ($this->dense) {
                return "height: 96px; max-height: 96px;";
            }
            return "height: 128px; max-height: 128px;";
        }
        if ($this->extended) {
            return "height: 128px; max-height: 128px;";
        }
        if ($this->dense) {
            return "height: 48px; max-height: 48px;";
        }
        return "height: 64px; max-height: 64px;";
    }

    public function getContentHeight()
    {
        if ($this->prominent) {
            if ($this->dense) {
                return "height: 96px;";
            }
            return "height: 128px;";
        }
        if ($this->dense) {
            return "height: 48px;";
        }
        return "height: 64px;";
    }
}

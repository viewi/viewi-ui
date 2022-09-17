<?php

namespace ViewiUI\Components\UI\Grid;

use Viewi\BaseComponent;

class Row extends BaseComponent
{
    public string $tag = 'div';
    public bool $dense = false;
    public bool $noGutters = false;

    public ?string $align = null;
    public ?string $alignContent = null;
    public ?string $justify = null;
    public ?string $style = null;
    public ?string $class = null;

    // screen breakpoints
    // align-xl|lg|md|sm
    // align-content-xl|lg|md|sm

    public function getClasses()
    {
        $breakpointClasses = '';
        foreach ($this->_props as $prop => $value) {
            if (
                strpos($prop, 'align-') === 0
                || strpos($prop, 'align-content-') === 0
                || strpos($prop, 'justify-') === 0
            ) {
                $breakpointClasses .= " $prop-$value";
            }
        }
        return 'row'
            . ($this->align ? ' align-' . $this->align : '')
            . ($this->noGutters ? ' no-gutters' : '')
            . ($this->dense ? ' dense' : '')
            . ($this->alignContent ? ' align-content-' . $this->alignContent : '')
            . ($this->justify ? ' justify-' . $this->justify : '')
            . $breakpointClasses
            . ($this->class !== null ? ' ' . $this->class : '');
    }
}

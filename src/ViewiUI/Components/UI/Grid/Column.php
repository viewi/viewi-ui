<?php

namespace ViewiUI\Components\UI\Grid;

use Viewi\BaseComponent;

class Column extends BaseComponent
{

    public ?string $cols = null;
    public ?string $xs = null;
    public ?string $sm = null;
    public ?string $md = null;
    public ?string $lg = null;
    public ?string $xl = null;
    public ?string $alignSelf = null;
    public ?string $order = null;
    public ?string $class = null;

    public function getClasses()
    {
        $breakpointClasses = '';
        foreach ($this->_props as $prop => $value) {
            if (
                strpos($prop, 'offset-') === 0
            ) {
                $breakpointClasses .= " $prop-$value";
            }
        }
        $hasColClasses = $this->cols || $this->xs || $this->sm || $this->md || $this->lg || $this->xl;
        return ($hasColClasses ? '' : 'col')
            . ($this->cols ? 'col-' . $this->cols : '')
            . ($this->alignSelf ? ' align-self-' . $this->alignSelf : '')
            . ($this->xs !== null ? ' col-xs-' . $this->xs : '')
            . ($this->sm !== null ? ' col-sm-' . $this->sm : '')
            . ($this->md !== null ? ' col-md-' . $this->md : '')
            . ($this->lg !== null ? ' col-lg-' . $this->lg : '')
            . ($this->xl !== null ? ' col-xl-' . $this->xl : '')
            . ($this->order ? ' order-' . $this->order : '')
            . $breakpointClasses
            . ($this->class ? ' ' . $this->class : '');
    }
}

<?php

namespace ViewiUI\Components\UI\Grid;

use Viewi\BaseComponent;

class Column extends BaseComponent
{

    public ?int $cols = null;
    public ?int $xs = null;
    public ?int $sm = null;
    public ?int $md = null;
    public ?int $lg = null;
    public ?int $xl = null;
    public ?string $alignSelf = null;

    public function getClasses()
    {
        $breakpointClasses = '';        
        foreach ($this->_props as $prop => $value) {
            if (
                strpos($prop, 'offset-') === 0
                || strpos($prop, 'order-') === 0
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
            . $breakpointClasses;
    }
}

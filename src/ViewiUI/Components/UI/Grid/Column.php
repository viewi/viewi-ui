<?php

namespace ViewiUI\Components\UI\Grid;

use Viewi\BaseComponent;

class Column extends BaseComponent
{

    public int $cols = 12;
    public ?int $xs = null;
    public ?int $sm = null;
    public ?int $md = null;
    public ?int $lg = null;
    public ?int $xl = null;
    public ?string $alignSelf = null;

    public function getClasses()
    {
        return 'col-' . $this->cols
            . ($this->alignSelf ? ' align-self-' . $this->alignSelf : '')
            . ($this->xs !== null ? ' col-xs-' . $this->xs : '')
            . ($this->sm !== null ? ' col-sm-' . $this->sm : '')
            . ($this->md !== null ? ' col-md-' . $this->md : '')
            . ($this->lg !== null ? ' col-lg-' . $this->lg : '')
            . ($this->xl !== null ? ' col-xl-' . $this->xl : '');
    }
}

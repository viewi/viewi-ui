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

    public function getClasses()
    {
        return 'row'
            . ($this->align ? ' align-' . $this->align : '')
            . ($this->noGutters ? ' no-gutters' : '')
            . ($this->alignContent ? ' align-content-' . $this->alignContent : '')
            . ($this->justify ? ' justify-' . $this->justify : '');
    }
}

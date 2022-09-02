<?php

namespace ViewiUI\Components\UI\Lists;

use Viewi\BaseComponent;

// Can't use name List as it's reserved PHP keyword
class ListContainer extends BaseComponent
{
    public bool $dense = false;
    public bool $nav = false;
    public bool $disabled = false;
    public bool $flat = false;
    public bool $rounded = false;
    public bool $shaped = false;
    public bool $threeLine = false;

    public function getClasses()
    {
        return 'viewi-list viewi-sheet theme-light'
            . ($this->threeLine ? ' list-three-line' : '');
    }
}

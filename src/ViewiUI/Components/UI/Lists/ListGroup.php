<?php

namespace ViewiUI\Components\UI\Lists;

use Viewi\BaseComponent;

class ListGroup extends BaseComponent
{
    public bool $subGroup = false;
    public bool $noAction = false;
    public bool $modelValue = false;
    public ?string $prependIcon = null;
    public ?string $title = null;
    public ?string $color = null;

    public function onToggle()
    {
        $this->modelValue = !$this->modelValue;
        $this->emitEvent('model', $this->modelValue);
    }
}

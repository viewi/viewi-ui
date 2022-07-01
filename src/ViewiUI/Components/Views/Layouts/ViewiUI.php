<?php

namespace ViewiUI\Components\Views\Layouts;

use Viewi\BaseComponent;

class ViewiUI extends BaseComponent
{
    /**
     * 
     * @var string[]
     */
    public array $icons = ['mdi'];

    public function isMaterial()
    {
        return in_array('mdi', $this->icons);
    }

    public function isFontAwesome4()
    {
        return in_array('fa4', $this->icons);
    }

    public function isFontAwesome5()
    {
        return in_array('fa5', $this->icons);
    }
}

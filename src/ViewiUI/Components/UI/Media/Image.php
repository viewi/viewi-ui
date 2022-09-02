<?php

namespace ViewiUI\Components\UI\Media;

use Viewi\BaseComponent;

class Image extends BaseComponent
{
    public ?string $class = null;
    public string $src = '';

    public function getStyle()
    {
        return "background-image: url('{$this->src}'); background-position: center center;";
    }
}

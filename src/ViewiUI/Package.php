<?php

namespace ViewiUI;

use Viewi\Packages\ViewiPackage;
use Viewi\PageEngine;

class Package extends ViewiPackage
{
    public function getComponentsPath(): ?string
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'Components';
    }

    public function getAssetsPath(): ?string
    {
        return __DIR__ . DIRECTORY_SEPARATOR . 'public';
    }

    public function onBuild(PageEngine $pageEngine): void
    {
        // nothing
    }
}

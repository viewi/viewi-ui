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

    public function onBuild(PageEngine $pageEngine): void
    {
        $assetsDestinationPath = $pageEngine->getConfig()[PageEngine::PUBLIC_ROOT_DIR];
        $assetsSourceDir = __DIR__ . DIRECTORY_SEPARATOR . 'public';
        // copy all assets
        $assets = [];
        $this->getDirContents($assetsSourceDir, $assets);
        foreach ($assets as $path => $type) {
            $basePath = str_replace($assetsSourceDir, '', $path);
            $destinationPath = $assetsDestinationPath . $basePath;
            // $pageEngine->debug([$type, $assetsSourceDir, $path, $basePath, $assetsDestinationPath, $destinationPath]);
            switch ($type) {
                case 'folder': {
                        if (!file_exists($destinationPath)) {
                            mkdir($destinationPath, 0777, true);
                        }
                        break;
                    }
                case 'file':
                default: {
                        // file
                        file_put_contents($destinationPath, file_get_contents($path));
                    }
            }
        }
    }

    private function getDirContents($dir, &$results = array())
    {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
            if (!is_dir($path)) {
                $results[$path] = 'file';
            } else if ($value != "." && $value != "..") {
                $results[$path] = 'folder';
                $this->getDirContents($path, $results);
            }
        }

        return $results;
    }
}

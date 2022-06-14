<?php

// php tools/css-generator/generate.php

echo 'PHP/CSS generator' . PHP_EOL;

function getDirContents($dir, &$results = array(), $includeFolders = false)
{
    $files = scandir($dir);

    foreach ($files as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
            $results[$path] = 'file';
        } else if ($value != "." && $value != "..") {
            if ($includeFolders) {
                $results[$path] = 'folder';
            }
            getDirContents($path, $results, $includeFolders);
        }
    }
    return $results;
}


$files = getDirContents(__DIR__);
$targetDir = __DIR__ . '/../../src/ViewiUI/public/viewi-ui/css';
foreach ($files as $file => $type) {
    if ($type === 'file') {
        $pathinfo = pathinfo($file);
        // print_r($pathinfo);
        if ($pathinfo['extension'] === 'phpcss') {
            echo "Processing $file" . PHP_EOL;
            ob_start();
            include $file;
            $result = ob_get_contents();
            ob_end_clean();
            $targetName = "$targetDir/{$pathinfo['filename']}.css";
            file_put_contents($targetName, $result);
        }
    }
}

<?php
function versionedAsset($path)
{
    if (app()->environment('local')) {
        $version = rand();
        return asset($path) . '?v=' . $version;
    }

    return asset($path);
}

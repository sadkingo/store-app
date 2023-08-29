<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

if (!function_exists('versionedAsset'))
    {
        function versionedAsset($path)
        {
        if (Storage::disk('public')->exists($path))
            {
            return url('/').'/storage/' . $path;
            }
        if (app()->environment('local'))
            {
            $version = rand();
            return asset($path) . '?v=' . $version;
            }

        return asset($path);
        }
    }
if (!function_exists('authUser'))
    {
    function authUser()
        {
        return Auth::user();
        }
    }

<?php

namespace App\Traits;


trait PathHelperTrait
{
    /**
     * Combines filePath with backend public path (.../app/public).
     * 
     * @param string $filePath
     * @return string
     */
    public function transformToPublic($filePath)
    {
        return storage_path() . "/app/public/{$filePath}";
    }
    public function transformToPrivate($filePath)
    {
        return storage_path() . "/app/private/{$filePath}";
    }
}

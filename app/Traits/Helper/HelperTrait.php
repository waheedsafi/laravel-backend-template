<?php

namespace App\Traits\Helper;


trait HelperTrait
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
}

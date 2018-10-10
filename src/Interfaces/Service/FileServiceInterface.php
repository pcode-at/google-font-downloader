<?php

namespace PCode\GoogleFontDownloader\Interfaces\Service;


/**
 * Interface FileServiceInterface
 * @package PCode\GoogleFontDownloader\Interfaces\Service
 */
interface FileServiceInterface
{
    /**
     * @param string $path
     * @param $content
     * @return mixed
     */
    public function write(string $path, $content);

    /**
     * @param string $id
     * @param string $extension
     * @param string $family
     * @param string $version
     * @param string $storeID
     * @return mixed
     */
    public function getPath(string $id, string $extension, string $family, string $version, string $storeID);
}
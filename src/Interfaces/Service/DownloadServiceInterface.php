<?php

namespace PCode\GoogleFontDownloader\Interfaces\Service;

use PCode\GoogleFontDownloader\Lib\Models\FontDTO;
use PCode\GoogleFontDownloader\Lib\Models\FontVariantsDTO;

/**
 * Interface DownloadServiceInterface
 * @package PCode\GoogleFontDownloader\Interfaces\Service
 */
interface DownloadServiceInterface
{
    /**
     * @param string $url
     * @param string $method
     * @param array $options
     * @return mixed
     */
    public function sendRequest(string $url, string $method, $options = ['verify' => false]);

    /**
     * @param FontDTO $fontDTO
     * @return void
     */
    public function handleFontResponse(FontDTO $fontDTO): void;

    /**
     * @param FontDTO $fontDTO
     * @return FontDTO
     */
    public function downloadFont(FontDTO $fontDTO);

    /**
     * @param null|FontVariantsDTO $variant
     */
    public function downloadFile(?FontVariantsDTO $variant): void;

    /**
     * @param FontVariantsDTO $variant
     * @return mixed
     */
    public function isAvailableForDownload(FontVariantsDTO $variant): bool;
}

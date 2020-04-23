<?php

namespace PCode\GoogleFontDownloader\Interfaces\Service;

use PCode\GoogleFontDownloader\Lib\Models\FontDTO;
use PCode\GoogleFontDownloader\Lib\Models\FontVariantsDTO;

interface DownloadServiceInterface
{
    /**
     * @param string $url
     * @param string $method
     * @param array $options
     * @return mixed
     */
    public function sendRequest($url, $method, $options = ['verify' => false]);

    /**
     * @param FontDTO $fontDTO
     * @return void
     */
    public function handleFontResponse(FontDTO $fontDTO);

    /**
     * @param FontDTO $fontDTO
     * @return FontDTO
     */
    public function downloadFont(FontDTO $fontDTO);

    /**
     * @param null|FontVariantsDTO $variant
     */
    public function downloadFile($variant);

    /**
     * @param FontVariantsDTO $variant
     * @return bool
     */
    public function isAvailableForDownload(FontVariantsDTO $variant);
}

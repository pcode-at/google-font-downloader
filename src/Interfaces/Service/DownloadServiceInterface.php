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
     * @return mixed
     */
    public function handleFontResponse(FontDTO $fontDTO);

    /**
     * @param null|string $font
     * @param FontDTO $fontDTO
     * @return mixed
     */
    public function downloadFont(?string $font, FontDTO $fontDTO);

    /**
     * @param null|FontVariantsDTO $variant
     */
    public function downloadFile(?FontVariantsDTO $variant): void;
}
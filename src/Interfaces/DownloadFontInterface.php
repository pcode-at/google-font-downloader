<?php

namespace PCode\GoogleFontDownloader\interfaces;


use PCode\GoogleFontDownloader\Lib\Models\FontDTO;

interface DownloadFontInterface
{
    /**
     * @param array $fonts
     */
    public function download(Array $fonts);

    /**
     * @param string $url
     * @return mixed
     */
    public function getMetadata(string $url);

    /**
     * @param $font
     * @return FontDTO
     */
    public function getFontDTO($font);
}
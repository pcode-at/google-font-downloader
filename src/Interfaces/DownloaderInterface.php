<?php

namespace PCode\GoogleFontDownloader\Interfaces;


use PCode\GoogleFontDownloader\Lib\Models\FontDTO;

/**
 * Interface DownloaderInterface
 * @package PCode\GoogleFontDownloader\Interfaces
 */
interface DownloaderInterface
{
    /**
     * @param array $fonts
     * @return FontDTO[]
     * @example download(['Arimo', 'Open Sans'])
     */
    public function download(array $fonts);

    /**
     * @param $font
     * @param string|null $version
     * @return FontDTO
     */
    public function getFontDTO($font, string $version);
}

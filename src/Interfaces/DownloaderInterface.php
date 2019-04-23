<?php

namespace PCode\GoogleFontDownloader\Interfaces;

use PCode\GoogleFontDownloader\Lib\FontExtension;
use PCode\GoogleFontDownloader\Lib\Models\FontDTO;

/**
 * Interface DownloaderInterface
 * @package PCode\GoogleFontDownloader\Interfaces
 */
interface DownloaderInterface
{
    /**
     * @param string $fontName
     * @param string|null $fontVersion
     * @param string|null $fontExtension
     * @return FontDTO[]
     * @example download('Open Sans', 'v12', 'woff2')
     */
    public function download(string $fontName, string $fontVersion, string $fontExtension = FontExtension::WOFF22);

    /**
     * @param string $fontName
     * @param string|null $fontExtension
     * @return FontDTO[]
     * @example download('Open Sans', 'woff2')
     */
    public function downloadLatest(string $fontName, string $fontExtension = FontExtension::WOFF22);

    /**
     * @param $font
     * @param string|null $version
     * @return FontDTO
     */
    public function getFontDTO($font, string $version);
}

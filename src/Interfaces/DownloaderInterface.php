<?php

namespace PCode\GoogleFontDownloader\Interfaces;

use PCode\GoogleFontDownloader\Lib\FontExtension;
use PCode\GoogleFontDownloader\Lib\Models\FontDTO;

interface DownloaderInterface
{
    /**
     * @param string $fontName
     * @param string $fontVersion
     * @param string $fontExtension
     * @return FontDTO
     */
    public function download($fontName, $fontVersion, $fontExtension = FontExtension::DEFAULT_EXTENSION);

    /**
     * @param string $fontName
     * @param string $fontExtension
     * @return FontDTO
     */
    public function downloadLatest($fontName, $fontExtension = FontExtension::DEFAULT_EXTENSION);

    /**
     * @param string $font
     * @param string $version
     * @return FontDTO
     */
    public function getFontDTO($font, $version);

    /**
     * Checks if font with specific version is available for download
     * 
     * @param string $fontName
     * @param string|null $version
     * @return bool
     */
    public function isFontAvailableForDownload($fontName, $version = null);
}

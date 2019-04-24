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
     * @param string $fontVersion
     * @param string $fontExtension
     * @return FontDTO
     */
    public function download(string $fontName, string $fontVersion, string $fontExtension = FontExtension::DEFAULT): FontDTO;

    /**
     * @param string $fontName
     * @param string $fontExtension
     * @return FontDTO
     */
    public function downloadLatest(string $fontName, string $fontExtension = FontExtension::DEFAULT): FontDTO;

    /**
     * @param string $font
     * @param string $version
     * @return FontDTO
     */
    public function getFontDTO(string $font, string $version): FontDTO;

    /**
     * Checks if font with specific version is available for download
     * @param string $fontName
     * @param string|null $version
     * @return bool
     */
    public function isFontAvailableForDownload(string $fontName, string $version = null): bool;
}

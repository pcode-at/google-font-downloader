<?php

namespace Pcode\GoogleFontDownloader;

use PCode\GoogleFontDownloader\Interfaces\DownloaderInterface;
use PCode\GoogleFontDownloader\Lib\DownloaderFactory;
use PHPUnit\Framework\TestCase;

class FontDownloaderTestCase extends TestCase
{
    const FONTS_DIR = __DIR__ . '/data/fonts';

    /**
     * @return DownloaderInterface
     */
    public function getDownloader() 
    {
        return DownloaderFactory::create(self::FONTS_DIR);
    }
}

<?php

namespace PCode\GoogleFontDownloader\Lib;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use PCode\GoogleFontDownloader\Interfaces\DownloaderInterface;
use PCode\GoogleFontDownloader\Lib\Service\DownloadService;
use PCode\GoogleFontDownloader\Lib\Service\FileService;
use PCode\GoogleFontDownloader\Lib\Service\FontService;

class DownloaderFactory
{
    /**
     * @param string $path
     * @return DownloaderInterface
     */
    public static function create($path)
    {
        $fileService = new FileService(
            new Filesystem(new Local($path))
        );
        
        $fontService = new FontService($fileService, basename($path) . '/');
        
        $downloadService = new DownloadService(new Client(), $fileService, $fontService);

        return new Downloader(
            $fileService,
            $fontService,
            $downloadService,
            new MajodevAPI($fontService, $downloadService, new Uri())
        );
    }
}

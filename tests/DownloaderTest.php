<?php

use GuzzleHttp\Psr7\Uri;
use PCode\GoogleFontDownloader\Lib\Downloader;
use PCode\GoogleFontDownloader\Lib\MajodevAPI;
use PCode\GoogleFontDownloader\Lib\Service\DownloadService;
use PCode\GoogleFontDownloader\Lib\Service\FileService;
use PCode\GoogleFontDownloader\Lib\Service\FontService;
use PHPUnit\Framework\TestCase;

class DownloaderTest extends TestCase
{
    public function testIsDownloaderInstanceAnObject()
    {
        $client = new GuzzleHttp\Client;
        $filesystemAdapter = new League\Flysystem\Adapter\Local('web/fonts');
        $filesystem = new League\Flysystem\Filesystem($filesystemAdapter);

        $fileService = new FileService($filesystem);
        $fontService = new FontService($fileService, 'fonts/');
        $downloadService = new DownloadService($client, $fileService, $fontService);
        $uri = new Uri();
        $apiService = new MajodevAPI($fontService, $downloadService, $uri);

        $downloader = new Downloader($fileService, $fontService, $downloadService, $apiService);
        $this->assertTrue(is_object($downloader));
        unset($downloader);
    }

    public function testDownload()
    {
        $client = new GuzzleHttp\Client;
        $filesystemAdapter = new League\Flysystem\Adapter\Local('web/fonts');
        $filesystem = new League\Flysystem\Filesystem($filesystemAdapter);

        $fileService = new FileService($filesystem);
        $fontService = new FontService($fileService, 'fonts/');
        $downloadService = new DownloadService($client, $fileService, $fontService);
        $uri = new Uri();
        $apiService = new MajodevAPI($fontService, $downloadService, $uri);

        $downloader = new Downloader($fileService, $fontService, $downloadService, $apiService);

        $fontsDTO = $downloader->download(["Arimo", "Open Sans"]);
        $this->assertTrue(is_array($fontsDTO));
        var_dump(sizeof($fontsDTO));

        unset($fontsDTO);
        unset($downloader);
    }
}
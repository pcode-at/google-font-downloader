<?php

use PHPUnit\Framework\TestCase;

class DownloaderTest extends TestCase
{
    public function testIsThereAnySyntaxError()
    {
        $client = new GuzzleHttp\Client;
        $filesystemAdapter = new League\Flysystem\Adapter\Local('web/fonts');
        $filesystem = new League\Flysystem\Filesystem($filesystemAdapter);

        $downloader = new PCode\GoogleFontDownloader\Lib\Downloader($client, $filesystem, 'fonts/');
        $this->assertTrue(is_object($downloader));
        unset($downloader);
    }

    public function testDownload()
    {
        $client = new GuzzleHttp\Client;
        $filesystemAdapter = new League\Flysystem\Adapter\Local('web/fonts');
        $filesystem = new League\Flysystem\Filesystem($filesystemAdapter);
        $downloader = new PCode\GoogleFontDownloader\Lib\Downloader($client, $filesystem, 'fonts/');

        $fontsDTO = $downloader->download(["Arimo", "Open Sans"]);
        $this->assertTrue(is_array($fontsDTO));
        var_dump(sizeof($fontsDTO));

        unset($fontsDTO);
        unset($downloader);
    }
}
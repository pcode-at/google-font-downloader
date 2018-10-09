<?php

use PHPUnit\Framework\TestCase;

class MajodevGoogleWebFontsHelperTest extends TestCase
{
    public function testIsThereAnySyntaxError()
    {
        $client = new GuzzleHttp\Client;
        $filesystemAdapter = new League\Flysystem\Adapter\Local('web/fonts');
        $filesystem = new League\Flysystem\Filesystem($filesystemAdapter);
        $service = new PCode\GoogleFontDownloader\Lib\MajodevGoogleWebFontsHelper($client, $filesystem, 'fonts/');
        $this->assertTrue(is_object($service));
        unset($service);
    }

    public function testDownload()
    {
        $client = new GuzzleHttp\Client;
        $filesystemAdapter = new League\Flysystem\Adapter\Local('web/fonts');
        $filesystem = new League\Flysystem\Filesystem($filesystemAdapter);
        $service = new PCode\GoogleFontDownloader\Lib\MajodevGoogleWebFontsHelper($client, $filesystem, 'fonts/');

        $fontDTOS = $service->download(["Arimo"]);
        $this->assertTrue(is_array($fontDTOS));
        var_dump($fontDTOS);
        unset($fontDTOS);
        unset($service);
    }
}
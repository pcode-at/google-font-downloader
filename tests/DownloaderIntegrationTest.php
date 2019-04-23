<?php

declare(strict_types=1);

namespace PCode\GoogleFontDownloader;

use PCode\GoogleFontDownloader\Lib\Models\FontDTO;

class DownloaderIntegrationTest extends FontDownloaderTestCase
{
    /**
     * @test
     * @dataProvider fontsToDownloadProvider
     * @param $fontName
     * @param $fontVersion
     */
    function it_downloads_font_with_provided_version($fontName, $fontVersion)
    {
        $downloader = $this->getDownloader();

        /** @var FontDTO $downloadedFont */
        $downloadedFont = $downloader->download($fontName, $fontVersion);

        $this->assertInstanceOf(FontDTO::class, $downloadedFont);

        foreach ($downloadedFont->getVariants() as $variant) {
            $this->assertFileExists("./tests/data/{$variant->getSrc()}");
        }
    }

    /** @test */
    function it_checks_if_font_with_provided_version_exists()
    {
        $downloader = $this->getDownloader();

        /** @var FontDTO $downloadedFont */
        $this->assertFalse($downloader->checkIfVersionExists("Raleway", "vXX"));
        $this->assertTrue($downloader->checkIfVersionExists("Open Sans", "v15"));
    }

    function fontsToDownloadProvider()
    {
        return [
            "Inconsolata v16" => [
                "name" => "Inconsolata",
                "version" => "v16"
            ],
            "Open Sans v15" => [
                "name" => "Open Sans",
                "version" => "v15",
            ],
        ];
    }
}

<?php

declare(strict_types=1);

namespace PCode\GoogleFontDownloader;

use GuzzleHttp\Psr7\Uri;
use League\Flysystem\Filesystem;
use PCode\GoogleFontDownloader\Lib\Downloader;
use PCode\GoogleFontDownloader\Lib\MajodevAPI;
use PCode\GoogleFontDownloader\Lib\Models\FontDTO;
use PCode\GoogleFontDownloader\Lib\Service\DownloadService;
use PCode\GoogleFontDownloader\Lib\Service\FileService;
use PCode\GoogleFontDownloader\Lib\Service\FontService;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use League\Flysystem\Adapter\Local;

class DownloaderTest extends TestCase
{
    /**
     * @test
     * @dataProvider fontsToDownloadProvider
     * @param array $fonts
     */
    function it_downloads_font_with_provided_version(array $fonts)
    {
        $filesystemAdapter = new Local('./tests/data/fonts');
        $filesystem = new Filesystem($filesystemAdapter);

        $fileService = new FileService($filesystem);
        $fontService = new FontService($fileService, 'fonts/');

        $downloadService = new DownloadService(new Client(), $fileService, $fontService);
        $api = new MajodevAPI($fontService, $downloadService, new Uri());

        $downloader = new Downloader($fileService, $fontService, $downloadService, $api);

        /** @var FontDTO[] $downloadedFonts */
        $downloadedFonts = $downloader->download($fonts);

        $this->assertTrue(count($downloadedFonts) === count($fonts));

        foreach ($downloadedFonts as $font) {
            foreach ($font->getVariants() as $variant) {
                $this->assertFileExists("./tests/data/{$variant->getSrc()}");
            }
        }
    }

    function fontsToDownloadProvider()
    {
        return [
            "Inconsolata v17" => [
                [
                    [
                    "name" => "Inconsolata",
                    "version" => "v17"
                    ]
                ],
            ],
            "Open Sans v14" => [
                [
                    [
                        "name" => "Open Sans",
                        "version" => "v14",
                    ]
                ],
            ],
            "Open Sans v14 and Incosolata v17" => [
                [
                    [
                        "name" => "Open Sans",
                        "version" => "v14",
                    ],
                    [
                        "name" => "Inconsolata",
                        "version" => "v17"
                    ]
                ],
            ],
        ];
    }
}

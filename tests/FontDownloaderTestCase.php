<?php

declare(strict_types=1);

namespace Pcode\GoogleFontDownloader;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Uri;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use PCode\GoogleFontDownloader\Lib\Downloader;
use PCode\GoogleFontDownloader\Lib\MajodevAPI;
use PCode\GoogleFontDownloader\Lib\Service\DownloadService;
use PCode\GoogleFontDownloader\Lib\Service\FileService;
use PCode\GoogleFontDownloader\Lib\Service\FontService;
use PHPUnit\Framework\TestCase;

class FontDownloaderTestCase extends TestCase
{
    protected const DATA_DIRECTORY = './tests/data/';

    protected const FONTS_DIR = 'fonts/';

    public function getDownloader(): Downloader
    {
        $filesystemAdapter = new Local(self::DATA_DIRECTORY.self::FONTS_DIR);
        $filesystem = new Filesystem($filesystemAdapter);

        $fileService = new FileService($filesystem);
        $fontService = new FontService($fileService,self::FONTS_DIR);

        $downloadService = new DownloadService(new Client(), $fileService, $fontService);
        $api = new MajodevAPI($fontService, $downloadService, new Uri());

        return new Downloader($fileService, $fontService, $downloadService, $api);
    }
}

<?php


namespace PCode\GoogleFontDownloader\Lib;


use GuzzleHttp\ClientInterface;
use League\Flysystem\FilesystemInterface;
use PCode\GoogleFontDownloader\Interfaces\APIInterface;
use PCode\GoogleFontDownloader\Interfaces\DownloaderInterface;
use PCode\GoogleFontDownloader\Interfaces\Service\DownloadServiceInterface;
use PCode\GoogleFontDownloader\Interfaces\Service\FileServiceInterface;
use PCode\GoogleFontDownloader\Interfaces\Service\FontServiceInterface;
use PCode\GoogleFontDownloader\Lib\Models\FontDTO;
use PCode\GoogleFontDownloader\Lib\Service\DownloadService;
use PCode\GoogleFontDownloader\Lib\Service\FileService;
use PCode\GoogleFontDownloader\Lib\Service\FontService;

class Downloader implements DownloaderInterface
{
    /**
     * @var DownloadServiceInterface
     */
    private $downloadService;
    /**
     * @var FontServiceInterface
     */
    private $fontService;
    /**
     * @var FileServiceInterface
     */
    private $fileService;
    /**
     * @var APIInterface
     */
    private $API;

    /**
     * DownloadFont constructor.
     * @param ClientInterface $client
     * @param FilesystemInterface $filesystem
     * @param string $localSrcDirectory
     * @param string $apiName
     */
    public function __construct(ClientInterface $client, FilesystemInterface $filesystem, string $localSrcDirectory, string $apiName = Downloader::MAJODEV_API)
    {
        $this->fileService = new FileService($filesystem);
        $this->fontService = new FontService($this->fileService, $localSrcDirectory);
        $this->downloadService = new DownloadService($client, $this->fileService, $this->fontService);
        $this->API = $this->getAPI($this->fontService, $this->downloadService, $apiName);
    }

    /**
     * @param array[string] $fonts
     * @return FontDTO[]
     * @example download(['Arimo', 'Open Sans'])
     */
    public function download(array $fonts)
    {
        $downloadFont = function ($font) {
            $fontDTO = $this->getFontDTO($font);
            return $this->downloadService->downloadFont($font, $fontDTO);
        };
        return array_map($downloadFont, $fonts);
    }

    /**
     * @param $font
     * @return FontDTO
     */
    public function getFontDTO($font)
    {
        $APIData = $this->API->getAPIData($font);
        return $this->fontService->createDTO($APIData);
    }

    protected function getAPI(FontServiceInterface $fontService, DownloadServiceInterface $downloadService, string $apiName)
    {
        if($apiName === Downloader::MAJODEV_API) {
            return new MajodevAPI($fontService, $downloadService);
        }
    }
}
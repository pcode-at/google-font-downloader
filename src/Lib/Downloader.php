<?php


namespace PCode\GoogleFontDownloader\Lib;


use PCode\GoogleFontDownloader\Interfaces\APIInterface;
use PCode\GoogleFontDownloader\Interfaces\DownloaderInterface;
use PCode\GoogleFontDownloader\Interfaces\Service\DownloadServiceInterface;
use PCode\GoogleFontDownloader\Interfaces\Service\FileServiceInterface;
use PCode\GoogleFontDownloader\Interfaces\Service\FontServiceInterface;
use PCode\GoogleFontDownloader\Lib\Models\FontDTO;

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
    private $api;

    /**
     * DownloadFont constructor.
     * @param FileServiceInterface $fileService
     * @param FontServiceInterface $fontService
     * @param DownloadServiceInterface $downloadService
     * @param APIInterface $api
     */
    public function __construct(FileServiceInterface $fileService, FontServiceInterface $fontService, DownloadServiceInterface $downloadService, APIInterface $api)
    {
        $this->fileService = $fileService;
        $this->fontService = $fontService;
        $this->downloadService = $downloadService;
        $this->api = $api;
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
        $APIData = $this->api->getMetadata($font);
        return $this->fontService->createDTO($APIData);
    }
}
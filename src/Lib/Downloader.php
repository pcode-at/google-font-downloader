<?php


namespace PCode\GoogleFontDownloader\Lib;


use PCode\GoogleFontDownloader\Exception\InvalidRequestFormat;
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
    public function __construct(
        FileServiceInterface $fileService,
        FontServiceInterface $fontService,
        DownloadServiceInterface $downloadService,
        APIInterface $api
    ) {
        $this->fileService = $fileService;
        $this->fontService = $fontService;
        $this->downloadService = $downloadService;
        $this->api = $api;
    }

    /**
     * @param array[string] $fonts
     * @return FontDTO[]
     * @example download([
     *   ['name' => 'Open Sans', 'version' => 'v12'],
     *   ['name' => 'Incosolata', 'version' => 'v13'],
     * ])
     */
    public function download(array $fonts)
    {
        $downloadedFonts = [];

        foreach ($fonts as $font) {
            if (array_keys($font) !== ['name', 'version']) {
                throw new InvalidRequestFormat(
                    "Please use following structure ['name' => 'FontName', 'version' => 'v12']"
                );
            }

            $fontDTO = $this->getFontDTO($font['name'], $font['version']);
            $downloadedFonts[] = $this->downloadService->downloadFont($font['name'], $fontDTO);
        }

        return $downloadedFonts;
    }

    /**
     * @param $font
     * @param string $version
     * @return FontDTO
     */
    public function getFontDTO($font, string $version = null)
    {
        $apiData = $this->api->getMetadata($font);

        if ($version) {
            $apiData['latest_version'] = $apiData['version'];
            $apiData['version'] = $version;
        }

        return $this->fontService->createDTO($apiData);
    }
}

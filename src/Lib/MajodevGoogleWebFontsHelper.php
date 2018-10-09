<?php

namespace PCode\GoogleFontDownloader\Lib;


use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use League\Flysystem\FilesystemInterface;
use PCode\GoogleFontDownloader\Interfaces\DownloadFontInterface;
use PCode\GoogleFontDownloader\Interfaces\FontServiceInterface;
use PCode\GoogleFontDownloader\Lib\Models\FontDTO;
use PCode\GoogleFontDownloader\Lib\Service\FontService;

/**
 * Class MajodevGoogleWebFontsHelperService
 * @package PCode\GoogleFontDownloader
 *
 * Github link: https://github.com/majodev/google-webfonts-helper
 *
 * @api https://google-webfonts-helper.herokuapp.com/api/fonts/<ID>/?subsets=<latin>
 */
class MajodevGoogleWebFontsHelper implements DownloadFontInterface
{
    public const API_URL = "https://google-webfonts-helper.herokuapp.com/";
    public const API_PATH = "api/fonts/";

    /**
     * @var FontServiceInterface $fontService
     */
    private $fontService;

    /**
     * GoogleWebFontsHelperMajodevAPIService constructor.
     * @param ClientInterface $client
     * @param FilesystemInterface $filesystem
     * @param string $localFontFilePath
     */
    public function __construct(ClientInterface $client, FilesystemInterface $filesystem, string $localFontFilePath)
    {
        $this->fontService = new FontService($client, $filesystem, $localFontFilePath);
    }

    /**
     * Download fonts from Google Helper API
     *
     * @param array $fonts
     * @return null|FontDTO[]
     * @api https://google-webfonts-helper.herokuapp.com/api/fonts/<ID>/?subsets=<latin>
     * @throws GuzzleException
     */
    public function download(array $fonts)
    {
        /** @var FontDTO[] $fontsDTO */
        $fontsDTO = [];

        /** @var array $fonts */
        foreach ($fonts as $font) {
            $fontsDTO[] = $this->downloadFont($font);
        }
        return $fontsDTO;
    }

    /**
     * @param string $url
     * @return mixed
     * @throws GuzzleException
     */
    public function getMetadata(string $url)
    {
        return $this->fontService->getContent($this->fontService->sendRequest($url, 'GET'));
    }

    /**
     * @param $font
     * @return FontDTO
     * @throws GuzzleException
     */
    public function getFontDTO($font)
    {
        $responseContent = $this->getAPIContent($font);
        $fontDTO = $this->fontService->createDTO($responseContent);
        return $fontDTO;
    }

    /**
     * @param $font
     * @return null|FontDTO
     * @throws GuzzleException
     */
    protected function downloadFont($font)
    {
        $fontDTO = $this->getFontDTO($font);
        $this->handleResponse($fontDTO);

        return $fontDTO;
    }

    /**
     * Use this function to handle response from Google Web Fonts Helper Majodev API
     *
     * @param FontDTO $fontDTO
     * @return void
     * @throws GuzzleException
     */
    protected function handleResponse($fontDTO)
    {
        foreach ($fontDTO->getVariants() as $variant) {
            $this->fontService->downloadFile($variant);
        }
    }

    /**
     * @param $font
     * @return mixed
     * @throws GuzzleException
     */
    protected function getAPIContent($font)
    {
        $urlAPIMetadata = MajodevGoogleWebFontsHelper::API_URL.MajodevGoogleWebFontsHelper::API_PATH.$this->normalizeName($font);
        $metadata = $this->getMetadata($urlAPIMetadata);

        // Add subsets to the url
        $url = $urlAPIMetadata.$this->getSubsetsUrlArguments($metadata['subsets']);
        $content = $this->fontService->getContent($this->fontService->sendRequest($url, 'GET'));

        return $content;
    }

    /**
     * @param array $subsets
     * @return string
     */
    protected function getSubsetsUrlArguments(array $subsets)
    {
        $subsetsString = '?subsets=';
        foreach ($subsets as $key => $subset) {
            $subsetsString = $subsetsString.$subset;

            if($key < sizeof($subsets) - 1) {
                $subsetsString = $subsetsString.',';
            }
        }
        return $subsetsString;
    }

    /**
     * @param null|string $name
     * @return null|string
     */
    protected function normalizeName(?string $name)
    {
        return strtolower(str_replace(' ', '-', $name));
    }
}
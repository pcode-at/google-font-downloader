<?php

namespace PCode\GoogleFontDownloader\Lib;


use PCode\GoogleFontDownloader\Interfaces\APIInterface;
use PCode\GoogleFontDownloader\Interfaces\Service\DownloadServiceInterface;
use PCode\GoogleFontDownloader\Interfaces\Service\FontServiceInterface;

/**
 * Class MajodevGoogleWebFontsHelperService
 * @package PCode\GoogleFontDownloader
 *
 * Github link: https://github.com/majodev/google-webfonts-helper
 *
 * @api https://google-webfonts-helper.herokuapp.com/api/fonts/<ID>/?subsets=<latin>
 */
final class MajodevAPI implements APIInterface
{
    /**
     * @var FontServiceInterface $fontService
     */
    private $fontService;
    /**
     * @var DownloadServiceInterface
     */
    private $downloadService;

    /**
     * GoogleWebFontsHelperMajodevAPIService constructor.
     * @param FontServiceInterface $fontService
     * @param DownloadServiceInterface $downloadService
     */
    public function __construct(FontServiceInterface $fontService, DownloadServiceInterface $downloadService)
    {
        $this->fontService = $fontService;
        $this->downloadService = $downloadService;
    }

    /**
     * @param string $url
     * @return mixed
     */
    public function getMetadata(string $url)
    {
        return $this->fontService->getContent($this->downloadService->sendRequest($url, 'GET'));
    }

    /**
     * @param null|string $font
     * @return mixed
     */
    public function getAPIData(?string $font)
    {
        $urlAPIMetadata = MajodevAPI::API_URL.MajodevAPI::API_PATH.$this->normalizeName($font);
        $metadata = $this->getMetadata($urlAPIMetadata);

        // Add subsets to the url
        $url = $urlAPIMetadata.$this->getSubsetsUrlArguments($metadata['subsets']);
        $content = $this->fontService->getContent($this->downloadService->sendRequest($url, 'GET'));

        return $content;
    }

    /**
     * @param null|string $name
     * @return null|string
     */
    public function normalizeName(?string $name)
    {
        if (!empty($name)) {
            return strtolower(str_replace(' ', '-', $name));
        }
        return $name;
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
}
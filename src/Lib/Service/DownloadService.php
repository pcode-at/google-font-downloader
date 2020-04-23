<?php

namespace PCode\GoogleFontDownloader\Lib\Service;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\ClientException;
use PCode\GoogleFontDownloader\Interfaces\Service\DownloadServiceInterface;
use PCode\GoogleFontDownloader\Interfaces\Service\FileServiceInterface;
use PCode\GoogleFontDownloader\Interfaces\Service\FontServiceInterface;
use PCode\GoogleFontDownloader\Lib\Models\FontDTO;
use PCode\GoogleFontDownloader\Lib\Models\FontVariantsDTO;

class DownloadService implements DownloadServiceInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var FileServiceInterface
     */
    private $fileService;

    /**
     * @var FontServiceInterface
     */
    private $fontService;

    /**
     * DownloadService constructor.
     * @param ClientInterface $client
     * @param FileServiceInterface $fileService
     * @param FontServiceInterface $fontService
     */
    public function __construct(
        ClientInterface $client,
        FileServiceInterface $fileService,
        FontServiceInterface $fontService
    ) {
        $this->client = $client;
        $this->fileService = $fileService;
        $this->fontService = $fontService;
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $options
     * @return mixed|\Psr\Http\Message\ResponseInterface
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function sendRequest($url, $method, $options = ['verify' => false])
    {
        return $this->client->request($method, $url, $options);
    }

    /**
     * @param FontDTO $fontDTO
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function handleFontResponse(FontDTO $fontDTO)
    {
        foreach ($fontDTO->getVariants() as $variant) {
            $this->downloadFile($variant);
        }
    }

    /**
     * @param FontDTO $fontDTO
     * @return FontDTO
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function downloadFont(FontDTO $fontDTO)
    {
        $this->handleFontResponse($fontDTO);

        return $fontDTO;
    }

    /**
     * @param null|FontVariantsDTO $variant
     * @return void
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function downloadFile($variant)
    {
        $fileResponse = $this->sendRequest($variant->getUrl(), 'GET');
        $fileContent = $this->fontService->getContent($fileResponse, false);
        $this->fileService->write($variant->getPath(), $fileContent);
    }

    /**
     * @param FontVariantsDTO $variant
     * @return bool
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function isAvailableForDownload(FontVariantsDTO $variant)
    {
        try {
            $this->sendRequest($variant->getUrl(), 'GET');
            return true;
        } catch (ClientException $e) {
            return false;
        }
    }
}

<?php

namespace PCode\GoogleFontDownloader\Interfaces;


use GuzzleHttp\Psr7\Response;
use PCode\GoogleFontDownloader\Lib\Models\FontDTO;
use PCode\GoogleFontDownloader\Lib\Models\FontVariantsDTO;

interface FontServiceInterface
{
    /**
     * @param null|FontVariantsDTO $variant
     * @return mixed
     */
    public function downloadFile(?FontVariantsDTO $variant);

    /**
     * @param string $filePath
     * @param $content
     * @return void
     */
    public function writeFile(string $filePath, $content);

    /**
     * @param $content
     * @return FontDTO
     */
    public function createDTO($content);

    /**
     * @param string $url
     * @param string $method
     * @param array $options
     * @return mixed
     */
    public function sendRequest(string $url, string $method, $options = ['verify' => false]);

    /**
     * @param string $id
     * @param string $extension
     * @param string $family
     * @param string $version
     * @param string $storeID
     * @return string
     */
    public function getFilePath(string $id, string $extension, string $family, string $version, string $storeID);

    /**
     * @param Response $response
     * @param bool $inJSONFormat
     * @return mixed
     */
    public function getContent(Response $response, bool $inJSONFormat = true);
}
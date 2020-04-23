<?php

namespace PCode\GoogleFontDownloader\Interfaces\Service;

use GuzzleHttp\Psr7\Response;
use PCode\GoogleFontDownloader\Lib\Models\FontDTO;

interface FontServiceInterface
{
    /**
     * @param $content
     * @param array $options
     * @return FontDTO
     */
    public function createDTO($content, $options = []);

    /**
     * @param Response $response
     * @param bool $inJSONFormat
     * @return mixed
     */
    public function getContent(Response $response, $inJSONFormat = true);
}

<?php

namespace PCode\GoogleFontDownloader\Lib\Service;


use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use League\Flysystem\FilesystemInterface;
use PCode\GoogleFontDownloader\Interfaces\FontServiceInterface;
use PCode\GoogleFontDownloader\Lib\Models\FontDTO;
use PCode\GoogleFontDownloader\Lib\Models\FontVariantsDTO;

class FontService implements FontServiceInterface
{
    //region Unicode range constants
    public const UNICODE_RANGE_LATIN = 'U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD';
    public const UNICODE_RANGE_LATIN_EXT = 'U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF';
    public const UNICODE_RANGE_VIETNAMESE = 'U+0102-0103, U+0110-0111, U+1EA0-1EF9, U+20AB';
    public const UNICODE_RANGE_HEBREW = 'U+0590-05FF, U+20AA, U+25CC, U+FB1D-FB4F';
    public const UNICODE_RANGE_GREEK = 'U+0370-03FF';
    public const UNICODE_RANGE_GREEK_EXT = 'U+1F00-1FFF';
    public const UNICODE_RANGE_CYRILLIC = 'U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116';
    public const UNICODE_RANGE_CYRILLIC_EXT = 'U+0460-052F, U+1C80-1C88, U+20B4, U+2DE0-2DFF, U+A640-A69F, U+FE2E-FE2F';
    public const UNICODE_RANGE_DEVANAGARI = 'U+0900-097F, U+1CD0-1CF6, U+1CF8-1CF9, U+200C-200D, U+20A8, U+20B9, U+25CC, U+A830-A839, U+A8E0-A8FB';
    public const UNICODE_RANGE_TELUGU = 'U+0951-0952, U+0964-0965, U+0C00-0C7F, U+1CDA, U+200C-200D, U+25CC';
    //endregion

    /**
     * @var ClientInterface
     */
    private $client;
    /**
     * @var FilesystemInterface
     */
    private $filesystem;
    /**
     * @var string
     */
    private $localFontFilePath;
    /**
     * @var null|string
     */
    private $errorMsg;

    /**
     * FontService constructor.
     * @param ClientInterface $client
     * @param FilesystemInterface $filesystem
     * @param string $localFontFilePath
     * @param null|string $errorMsg
     */
    public function __construct(ClientInterface $client, FilesystemInterface $filesystem, string $localFontFilePath, ?string $errorMsg)
    {
        $this->filesystem = $filesystem;
        $this->localFontFilePath = $localFontFilePath;
        $this->client = $client;
        $this->errorMsg = $errorMsg;
    }

    /**
     * @param null|FontVariantsDTO $variant
     * @throws GuzzleException
     */
    public function downloadFile(?FontVariantsDTO $variant): void
    {
        $response = $this->sendRequest($variant->getUrl(), 'GET');
        $content = $this->getContent($response, false);
        $this->writeFile($variant->getPath(), $content);
    }

    /**
     * @param string $filePath
     * @param $content
     * @return void
     */
    public function writeFile(string $filePath, $content)
    {
        if (!$this->filesystem->has($filePath)) {
            $this->filesystem->put($filePath, $content);
        }
    }

    /**
     * @param string $url
     * @param string $method
     * @param array $options
     * @return mixed
     * @throws GuzzleException
     */
    public function sendRequest(string $url, string $method, $options = ['verify' => false])
    {
        return $this->client->request($method, $url, $options);
    }

    /**
     * @param string $id
     * @param string $extension
     * @param string $family
     * @param string $version
     * @param string $storeID
     * @return string
     */
    public function getFilePath(string $id, string $extension, string $family, string $version, string $storeID)
    {
        return $family.'/'.$family.'-'.$version.'-'.$storeID.'-'.$id.'.'.$extension;
    }

    /**
     * @param $content
     * @return FontDTO
     */
    public function createDTO($content)
    {
        $unicodeRanges = [];
        $variants = $this->createVariants($content);
        $this->setUnicodeRange($unicodeRanges, $content);
        return FontDTO::fromAPI($content['id'], $content['family'], $content['family'], $variants, $content['subsets'], $content['version'], $unicodeRanges, $content['storeID']);
    }

    /**
     * @param Response $response
     * @param bool $inJSONFormat
     * @return mixed
     */
    public function getContent(Response $response, bool $inJSONFormat = true)
    {
        if ($inJSONFormat === true) {
            return json_decode($response->getBody()->getContents(), true);
        }
        return $response->getBody()->getContents();
    }

    /**
     * @param $content
     * @return FontVariantsDTO[]
     */
    protected function createVariants($content)
    {
        $variants = [];
        foreach ($content['variants'] as $variant) {
            $URLAndExtensionForVariant = $this->getURLAndExtensionForVariant($variant);
            $extension = $URLAndExtensionForVariant['extension'];
            $url = $URLAndExtensionForVariant['url'];
            $filePath = $this->getFilePath($variant['id'], $extension, $content['family'], $content['version'], $content['storeID']);
            $localSrc = '/'.$this->localFontFilePath.$filePath;

            $variants[] = FontVariantsDTO::fromAPI($variant['id'], $variant['fontFamily'], $variant['fontStyle'], $variant['fontWeight'], $variant['local'],
                $url, $localSrc, $filePath, $extension
            );
        }
        return $variants;
    }

    /**
     * @param $unicodeRanges
     * @param $content
     * @return void
     */
    protected function setUnicodeRange($unicodeRanges, $content)
    {
        $unicodeRangesWithSubsetsKeys = [
            "latin" => FontService::UNICODE_RANGE_LATIN,
            "latin-ext" => FontService::UNICODE_RANGE_LATIN_EXT,
            "vietnamese" => FontService::UNICODE_RANGE_VIETNAMESE,
            "hebrew" => FontService::UNICODE_RANGE_HEBREW,
            "cyrillic" => FontService::UNICODE_RANGE_CYRILLIC,
            "cyrillic-ext" => FontService::UNICODE_RANGE_CYRILLIC_EXT,
            "greek" => FontService::UNICODE_RANGE_GREEK,
            "greek-ext" => FontService::UNICODE_RANGE_GREEK_EXT,
            "devanagari" => FontService::UNICODE_RANGE_DEVANAGARI,
            "telugu" => FontService::UNICODE_RANGE_TELUGU
        ];

        foreach ($content['subsets'] as $subset) {
            if(!empty($unicodeRangesWithSubsetsKeys[$subset])) {
                $unicodeRanges[] = [$subset => $unicodeRangesWithSubsetsKeys[$subset]];
            }
        }
    }

    /**
     * @param array $variant
     * @return array
     */
    protected function getURLAndExtensionForVariant(array $variant)
    {
        $fontExtensions = array("woff2", "woff", "ttf");
        $url = '';
        $extension = '';

        foreach ($fontExtensions as $fontExtension) {
            if(!empty($variant[$fontExtension])) {
                $url = $variant[$fontExtension];
                $extension = $fontExtension;
                break;
            }
        }

        return ['url' => $url, 'extension' => $extension];
    }
}
<?php

namespace PCode\GoogleFontDownloader\Lib\Models;

final class FontVariantsDTO
{
    /**
     * @var null|string id
     */
    private $id;

    /**
     * @var null|string fontFamily
     */
    private $fontFamily;

    /**
     * @var null|string fontStyle
     */
    private $fontStyle;

    /**
     * @var null|string fontWeight
     */
    private $fontWeight;

    /**
     * @var null|string[] local
     */
    private $local;

    /**
     * @var null|string url
     */
    private $url;

    /**
     * @var null|string directory
     */
    private $src;

    /**
     * @var null|string path
     */
    private $path;

    /**
     * @var null|string extension
     */
    private $extension;

    /**
     * FontVariantsDataTransferObject constructor.
     * @param null|string $id
     * @param null|string $fontFamily
     * @param null|string $fontStyle
     * @param null|string $fontWeight
     * @param null|string[] $local
     * @param null|string $url
     * @param null|string $src
     * @param null|string $path
     * @param null|string $extension
     */
    private function __construct(
        $id,
        $fontFamily,
        $fontStyle,
        $fontWeight,
        $local,
        $url,
        $src,
        $path,
        $extension
    ) {
        $this->id = $id;
        $this->fontFamily = $fontFamily;
        $this->fontStyle = $fontStyle;
        $this->fontWeight = $fontWeight;
        $this->local = $local;
        $this->url = $url;
        $this->src = $src;
        $this->path = $path;
        $this->extension = $extension;
    }

    public static function fromAPI(
        $id,
        $fontFamily,
        $fontStyle,
        $fontWeight,
        $local,
        $url,
        $src,
        $path,
        $extension
    ) {
        return new FontVariantsDTO($id, $fontFamily, $fontStyle, $fontWeight, $local, $url, $src, $path, $extension);
    }

    /**
     * @return null|string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null|string $id
     * @return void
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return null|string
     */
    public function getFontFamily()
    {
        return $this->fontFamily;
    }

    /**
     * @param null|string $fontFamily
     * @return void
     */
    public function setFontFamily($fontFamily)
    {
        $this->fontFamily = $fontFamily;
    }

    /**
     * @return null|string
     */
    public function getFontStyle()
    {
        return $this->fontStyle;
    }

    /**
     * @param null|string $fontStyle
     * @return void
     */
    public function setFontStyle($fontStyle)
    {
        $this->fontStyle = $fontStyle;
    }

    /**
     * @return null|string
     */
    public function getFontWeight()
    {
        return $this->fontWeight;
    }

    /**
     * @param null|string $fontWeight
     * @return void
     */
    public function setFontWeight($fontWeight)
    {
        $this->fontWeight = $fontWeight;
    }

    /**
     * @return null|string[]
     */
    public function getLocal()
    {
        return $this->local;
    }

    /**
     * @param null|string[] $local
     * @return void
     */
    public function setLocal($local)
    {
        $this->local = $local;
    }

    /**
     * @return null|string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param null|string $url
     * @return void
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @return null|string
     */
    public function getSrc()
    {
        return $this->src;
    }

    /**
     * @param null|string $src
     * @return void
     */
    public function setSrc($src)
    {
        $this->src = $src;
    }

    /**
     * @return null|string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param null|string $path
     * @return void
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return null|string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param null|string $extension
     * @return void
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }
}

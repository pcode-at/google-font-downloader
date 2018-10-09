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
        ?string $id,
        ?string $fontFamily,
        ?string $fontStyle,
        ?string $fontWeight,
        ?array $local,
        ?string $url,
        ?string $src,
        ?string $path,
        ?string $extension
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
        ?string $id,
        ?string $fontFamily,
        ?string $fontStyle,
        ?string $fontWeight,
        ?array $local,
        ?string $url,
        ?string $src,
        ?string $path,
        ?string $extension
    )
    {
        return new FontVariantsDTO($id, $fontFamily, $fontStyle, $fontWeight, $local, $url, $src, $path, $extension);
    }

    /**
     * @return null|string
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * @param null|string $id
     */
    public function setId(?string $id): void
    {
        $this->id = $id;
    }

    /**
     * @return null|string
     */
    public function getFontFamily(): ?string
    {
        return $this->fontFamily;
    }

    /**
     * @param null|string $fontFamily
     */
    public function setFontFamily(?string $fontFamily): void
    {
        $this->fontFamily = $fontFamily;
    }

    /**
     * @return null|string
     */
    public function getFontStyle(): ?string
    {
        return $this->fontStyle;
    }

    /**
     * @param null|string $fontStyle
     */
    public function setFontStyle(?string $fontStyle): void
    {
        $this->fontStyle = $fontStyle;
    }

    /**
     * @return null|string
     */
    public function getFontWeight(): ?string
    {
        return $this->fontWeight;
    }

    /**
     * @param null|string $fontWeight
     */
    public function setFontWeight(?string $fontWeight): void
    {
        $this->fontWeight = $fontWeight;
    }

    /**
     * @return null|string[]
     */
    public function getLocal(): ?array
    {
        return $this->local;
    }

    /**
     * @param null|string[] $local
     */
    public function setLocal(?array $local): void
    {
        $this->local = $local;
    }

    /**
     * @return null|string
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param null|string $url
     */
    public function setUrl(?string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return null|string
     */
    public function getSrc(): ?string
    {
        return $this->src;
    }

    /**
     * @param null|string $src
     */
    public function setSrc(?string $src): void
    {
        $this->src = $src;
    }

    /**
     * @return null|string
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @param null|string $path
     */
    public function setPath(?string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return null|string
     */
    public function getExtension(): ?string
    {
        return $this->extension;
    }

    /**
     * @param null|string $extension
     */
    public function setExtension(?string $extension): void
    {
        $this->extension = $extension;
    }
}
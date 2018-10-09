<?php

namespace PCode\GoogleFontDownloader\Lib\Models;

final class FontDTO
{
    /**
     * @var null|string id
     */
    private $id;

    /**
     * @var null|string name
     */
    private $name;

    /**
     * @var null|string family
     */
    private $family;

    /**
     * @var null|FontVariantsDTO[] variants
     */
    private $variants;

    /**
     * @var null|string[] subsets
     */
    private $subsets;

    /**
     * @var null|string version
     */
    private $version;

    /**
     * @var null|array unicodeRanges
     */
    private $unicodeRanges;

    /**
     * @var null|string storeID
     */
    private $storeId;

    /**
     * FontDataTransferObject constructor.
     * @param null|string $id
     * @param null|string $name
     * @param null|string $family
     * @param null|FontVariantsDTO[] $variants
     * @param null|string[] $subsets
     * @param null|string $version
     * @param array|null $unicodeRanges
     * @param null|string $storeID
     */
    private function __construct(?string $id, ?string $name, ?string $family, ?array $variants, ?array $subsets, ?string $version, ?array $unicodeRanges, ?string $storeID)
    {
        $this->id = $id;
        $this->name = $name;
        $this->family = $family;
        $this->variants = $variants;
        $this->subsets = $subsets;
        $this->version = $version;
        $this->unicodeRanges = $unicodeRanges;
        $this->storeId = $storeID;
    }

    /**
     * @param null|string $id
     * @param null|string $name
     * @param null|string $family
     * @param array|null $variants
     * @param array|null $subsets
     * @param null|string $version
     * @param array|null $unicodeRanges
     * @param null|string $storeID
     * @return FontDTO
     */
    public static function fromAPI(?string $id, ?string $name, ?string $family, ?array $variants, ?array $subsets, ?string $version, ?array $unicodeRanges, ?string $storeID)
    {
        return new FontDTO($id, $name, $family, $variants, $subsets, $version, $unicodeRanges, $storeID);
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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return null|string
     */
    public function getFamily(): ?string
    {
        return $this->family;
    }

    /**
     * @param null|string $family
     */
    public function setFamily(?string $family): void
    {
        $this->family = $family;
    }

    /**
     * @return null|FontVariantsDTO[]
     */
    public function getVariants(): ?array
    {
        return $this->variants;
    }

    /**
     * @param null|FontVariantsDTO[] $variants
     */
    public function setVariants(?array $variants): void
    {
        $this->variants = $variants;
    }

    /**
     * @return null|string[]
     */
    public function getSubsets(): ?array
    {
        return $this->subsets;
    }

    /**
     * @param null|string[] $subsets
     */
    public function setSubsets(?array $subsets): void
    {
        $this->subsets = $subsets;
    }

    /**
     * @return null|string
     */
    public function getVersion(): ?string
    {
        return $this->version;
    }

    /**
     * @param null|string $version
     */
    public function setVersion(?string $version): void
    {
        $this->version = $version;
    }

    /**
     * @return array|null
     */
    public function getUnicodeRanges(): ?array
    {
        return $this->unicodeRanges;
    }

    /**
     * @param array|null $unicodeRanges
     */
    public function setUnicodeRanges(?array $unicodeRanges): void
    {
        $this->unicodeRanges = $unicodeRanges;
    }

    /**
     * @return null|string
     */
    public function getStoreId(): ?string
    {
        return $this->storeId;
    }

    /**
     * @param null|string $storeId
     */
    public function setStoreId(?string $storeId): void
    {
        $this->storeId = $storeId;
    }
}
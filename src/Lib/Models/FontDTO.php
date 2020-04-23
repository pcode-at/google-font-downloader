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
     * @param null|array $unicodeRanges
     * @param null|string $storeID
     */
    private function __construct($id, $name, $family, $variants, $subsets, $version, $unicodeRanges, $storeID)
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
     * @param string|null $id
     * @param string|null $name
     * @param string|null $family
     * @param array|null $variants
     * @param array|null $subsets
     * @param string|null $version
     * @param array|null $unicodeRanges
     * @param string|null $storeID
     * @return FontDTO
     */
    public static function fromAPI($id, $name, $family, $variants, $subsets, $version, $unicodeRanges, $storeID)
    {
        return new FontDTO($id, $name, $family, $variants, $subsets, $version, $unicodeRanges, $storeID);
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
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return null|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     * @return void
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return null|string
     */
    public function getFamily()
    {
        return $this->family;
    }

    /**
     * @param null|string $family
     * @return void
     */
    public function setFamily($family)
    {
        $this->family = $family;
    }

    /**
     * @return null|FontVariantsDTO[]
     */
    public function getVariants()
    {
        return $this->variants;
    }

    /**
     * @param null|FontVariantsDTO[] $variants
     * @return void
     */
    public function setVariants($variants)
    {
        $this->variants = $variants;
    }

    /**
     * @return null|string[]
     */
    public function getSubsets()
    {
        return $this->subsets;
    }

    /**
     * @param null|string[] $subsets
     */
    public function setSubsets($subsets)
    {
        $this->subsets = $subsets;
    }

    /**
     * @return null|string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param null|string $version
     * @return void
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return array|null
     */
    public function getUnicodeRanges()
    {
        return $this->unicodeRanges;
    }

    /**
     * @param array|null $unicodeRanges
     * @return void
     */
    public function setUnicodeRanges($unicodeRanges)
    {
        $this->unicodeRanges = $unicodeRanges;
    }

    /**
     * @return null|string
     */
    public function getStoreId()
    {
        return $this->storeId;
    }

    /**
     * @param null|string $storeId
     */
    public function setStoreId($storeId)
    {
        $this->storeId = $storeId;
    }

    /**
     * @param string $requestedVersion
     * @return void
     */
    public function changeVersion($requestedVersion)
    {
        foreach ($this->variants as $variant) {
            $variant->setUrl(str_replace($this->version, $requestedVersion, $variant->getUrl()));
            $variant->setPath(str_replace($this->version, $requestedVersion, $variant->getPath()));
            $variant->setSrc(str_replace($this->version, $requestedVersion, $variant->getSrc()));
        }
    }
}

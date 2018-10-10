<?php


namespace PCode\GoogleFontDownloader\Lib\Service;


use League\Flysystem\FilesystemInterface;
use PCode\GoogleFontDownloader\Interfaces\Service\FileServiceInterface;

class FileService implements FileServiceInterface
{
    /**
     * @var FilesystemInterface
     */
    private $filesystem;

    /**
     * FileService constructor.
     * @param FilesystemInterface $filesystem
     */
    public function __construct(FilesystemInterface $filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @param string $path
     * @param $content
     */
    public function write(string $path, $content)
    {
        if (!$this->filesystem->has($path)) {
            $this->filesystem->put($path, $content);
        }
    }

    /**
     * @param string $id
     * @param string $extension
     * @param string $family
     * @param string $version
     * @param string $storeID
     * @return mixed|string
     */
    public function getPath(string $id, string $extension, string $family, string $version, string $storeID)
    {
        return $family.'/'.$family.'-'.$version.'-'.$storeID.'-'.$id.'.'.$extension;
    }
}
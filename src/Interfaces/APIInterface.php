<?php

namespace PCode\GoogleFontDownloader\Interfaces;

interface APIInterface
{
    /**
     * @param string $url
     * @return mixed
     */
    public function getMetadata($url);

    /**
     * @param string|null $name
     * @return mixed
     */
    public function normalizeName($name);
}

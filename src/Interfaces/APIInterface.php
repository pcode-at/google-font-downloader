<?php

namespace PCode\GoogleFontDownloader\Interfaces;


/**
 * Interface APIInterface
 * @package PCode\GoogleFontDownloader\Interfaces
 */
interface APIInterface
{
    public const API_URL = "https://google-webfonts-helper.herokuapp.com/";
    public const API_PATH = "api/fonts/";

    /**
     * @param string $url
     * @return mixed
     */
    public function getMetadata(string $url);

    /**
     * @param null|string $font
     * @return mixed
     */
    public function getAPIData(?string $font);

    /**
     * @param null|string $name
     * @return mixed
     */
    public function normalizeName(?string $name);
}
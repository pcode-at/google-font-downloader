<?php

namespace PCode\GoogleFontDownloader\Lib;

interface FontExtension
{
    const WOFF22 = 'woff2';
    const WOFF = 'woff';
    const TTF = 'ttf';
    const DEFAULT_EXTENSION = self::WOFF22;
}

# Composer package

# Google font downloader

## Description

This package will download all fonts that is inside the array $fonts

    Array example: ['Arimo', 'Open Sans']
    
and will place it depends on the provided $filesystem and $localFontFilePath
in the constructor of the package class.

## APIs

    https://google-webfonts-helper.herokuapp.com
    
## Available methods

    download (array $fonts)
    getMetadata (string $url)
    getFontDTO ($font)

## Third-party libraries

    GuzzleHttp
    League
    PHPUnit
    
## Usage example

```PHP
$client = new GuzzleHttp\Client;
$filesystemAdapter = new League\Flysystem\Adapter\Local('web/fonts');
$filesystem = new League\Flysystem\Filesystem($filesystemAdapter);
$service = new PCode\GoogleFontDownloader\Lib\MajodevGoogleWebFontsHelper($client, $filesystem, 'fonts/');
```   

## Useful git commands

    # Clean repo
    git clean -xfd
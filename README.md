# Google font downloader

## Description

This package will download all fonts that is inside the array $fonts

    Array example: ['Arimo', 'Open Sans']
    
and will place it depends on the provided $filesystem and $localSrcDirectory
in the constructor of the package class.

$localSrcDirectory is local directory there is saved font files structured in folders named like font name,
 recommended is this folder name to be a **fonts** and variable value should be *'fonts/'*. 

## Available APIs

- https://google-webfonts-helper.herokuapp.com
    
## Available methods

    # example: download(['Arimo', 'Open Sans']);
    download (array $fonts)
    
    # example: getFontDTO('Arimo');
    getFontDTO (string $fontName)

## Third-party libraries

    GuzzleHttp
    League
    PHPUnit
    
## Constraints

- Code is written in php 7.1
    
## Usage example

### Symfony usage

```PHP
# - create service for Downloader
# - inject this service in your service
# - instantiate in the controller DownloaderInterface $downloader
# - work with interface object $downloader
```

### Basic usage

```PHP
$client = new GuzzleHttp\Client;
$filesystemAdapter = new League\Flysystem\Adapter\Local('web/fonts');
$filesystem = new League\Flysystem\Filesystem($filesystemAdapter);
$localSrcDirectory = 'fonts/';
# optional
$apiName = DownloaderInterface::MAJODEV_API;

# $apiName is optinal argument, default is MajodevAPI, in DownloaderInterface you can find all availabe APIs,
# for now only availabe is MajodevAPI 
$downloader = new PCode\GoogleFontDownloader\Lib\Downloader($client, $filesystem, $localSrcDirectory, $apiName);
```   

## Useful git commands

    # Clean repo
    git clean -xfd
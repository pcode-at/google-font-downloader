# Google font downloader

## Description

This package will download all fonts that is inside the array $fonts

    Array example: ['Arimo', 'Open Sans']
    
and will place it depends on the provided services in the constructor of the package class.

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

## Recommended dependencies

 - GuzzleHttp
 - League\Flysystem
    
## Usage example

### Symfony usage

```PHP
# - create services for Downloader
# - one for local one for export
# - inject this services in your services
# - instantiate in the controller DownloaderInterface $downloader
# - work with interface object $downloader

#Here is one example of Downloader services

sity.guzzle_http.uri:
        class: GuzzleHttp\Psr7\Uri
        
sity.font_local.flysystem_adapter:
    class: League\Flysystem\Adapter\Local
    arguments:
        - '%kernel.root_dir%/../%sity.fonts.web_path%'

sity.font_local.flysystem:
    class: League\Flysystem\Filesystem
    arguments: ['@sity.font_local.flysystem_adapter']

sity.font_export.flysystem_adapter:
    class: League\Flysystem\Adapter\Local
    arguments: ['%kernel.root_dir%/../%sity.export.dir%', true]

sity.downloader.local_file:
    class: PCode\GoogleFontDownloader\Lib\Service\FileService
    arguments:
        - '@sity.font_local.flysystem'

sity.downloader.export_file:
    class: PCode\GoogleFontDownloader\Lib\Service\FileService
    arguments:
        - '@sity.font_export.flysystem'

sity.downloader.local_font:
    class: PCode\GoogleFontDownloader\Lib\Service\FontService
    arguments:
        - '@sity.downloader.local_file'
        - '%sity.fonts.path%'

sity.downloader.export_font:
    class: PCode\GoogleFontDownloader\Lib\Service\FontService
    arguments:
        - '@sity.downloader.export_file'
        - '%sity.fonts.path%'

sity.downloader.local_download:
    class: PCode\GoogleFontDownloader\Lib\Service\DownloadService
    arguments:
        - '@sity.client.guzzle_http'
        - '@sity.downloader.local_file'
        - '@sity.downloader.local_font'

sity.downloader.export_download:
    class: PCode\GoogleFontDownloader\Lib\Service\DownloadService
    arguments:
        - '@sity.client.guzzle_http'
        - '@sity.downloader.export_file'
        - '@sity.downloader.export_font'

sity.downloader.local_majodev_api:
    class: PCode\GoogleFontDownloader\Lib\MajodevAPI
    arguments:
        - '@sity.downloader.local_font'
        - '@sity.downloader.local_download'
        - '@sity.guzzle_http.uri'

sity.downloader.export_majodev_api:
    class: PCode\GoogleFontDownloader\Lib\MajodevAPI
    arguments:
        - '@sity.downloader.export_font'
        - '@sity.downloader.export_download'
        - '@sity.guzzle_http.uri'

sity.downloader.local:
    class: PCode\GoogleFontDownloader\Lib\Downloader
    arguments:
        - '@sity.downloader.local_file'
        - '@sity.downloader.local_font'
        - '@sity.downloader.local_download'
        - '@sity.downloader.local_majodev_api'

sity.downloader.export:
    class: PCode\GoogleFontDownloader\Lib\Downloader
    arguments:
        - '@sity.downloader.export_file'
        - '@sity.downloader.export_font'
        - '@sity.downloader.export_download'
        - '@sity.downloader.export_majodev_api'
        
        
## In the constructor

public function __construct(DownloaderInterface $downloadFonts , [...])
{
    $this->downloadFonts = $downloadFonts;
    ...        
}

# Then use it like

$downloadedFonts = $this->downloadFonts->download(['Arimo, Open Sans']);

```

### Basic usage

```PHP
$client = new GuzzleHttp\Client;
$filesystemAdapter = new League\Flysystem\Adapter\Local('web/fonts');
$filesystem = new League\Flysystem\Filesystem($filesystemAdapter);

$fileService = new FileService($filesystem);
$fontService = new FontService($fileService, 'fonts/');
$downloadService = new DownloadService($client, $fileService, $fontService);
$uri = new Uri();
$api = new MajodevAPI($fontService, $downloadService, $uri);

$downloader = new Downloader($fileService, $fontService, $downloadService, $api);
```   

## Useful git commands

    # Clean repo
    git clean -xfd
    
## Contributing

Use **dev-env** branch

## Licence

MIT
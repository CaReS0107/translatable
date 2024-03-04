<?php

namespace Translatable\Translatable\Commands;

use Illuminate\Console\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RegexIterator;

class TranslatableCommand extends Command
{
    protected $signature = 'app:check-translations';

    protected $description = 'Check PHP files for translations and compare with location json files';

    public function handle(): int
    {
        $translatableFilePaths = $this->getTranslatableFiles();

        if (empty($translatableFilePaths)) {
            $this->warn('No translatable files found');

            return 0;
        }

        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(base_path().'/app'));
        $phpFiles = new RegexIterator($files, '/\.php$/');

        foreach ($phpFiles as $phpFile) {
            if (! strpos($phpFile->getRealPath(), DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR)) {
                $this->info('Checking: '.$phpFile->getRealPath());
                $content = file_get_contents($phpFile->getRealPath());

                if (preg_match_all("/__\(['\"](.*?)['\"]\)/", $content, $matches)) {
                    foreach ($matches[1] as $match) {
                        $this->info("Found translation: $match in file ".$phpFile->getRealPath());

                        foreach ($translatableFilePaths as $path) {
                            $translationContent = json_decode(file_get_contents($path), true);

                            if (! array_key_exists($match, $translationContent)) {
                                $translationContent[$match] = '';
                                file_put_contents($path, json_encode($translationContent, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                                $this->info("Added missing translation for '{$match}' in '{$path}'");
                            }
                        }
                    }
                }
            }
        }

        return 1;
    }

    public function getTranslatableFiles(): array
    {
        $availableCountries = config('translatable.available_countries');
        $translatableFilePaths = [];
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(config('translatable.translation_files_path')));

        foreach ($availableCountries as $countryCode) {
            foreach ($iterator as $file) {

                if ($file->isDir()) {

                    if (strpos($file->getRealPath(), '/vendor/')) {
                        continue;
                    }

                    continue;
                }

                $fileName = "{$countryCode}.json";

                if ($file->getFilename() === $fileName) {
                    if (! app()->runningUnitTests()) {
                        $this->info("Found translation file for: {$fileName}");
                    }

                    $translatableFilePaths[] = $file->getRealPath();
                }
            }
        }

        return array_filter($translatableFilePaths);
    }
}

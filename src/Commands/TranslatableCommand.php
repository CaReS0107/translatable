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

    /**
     * @throws \JsonException
     */
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
            if (str_contains($phpFile->getRealPath(), '/vendor/')) {
                continue;
            }

            $this->info('Checking: '.$phpFile->getRealPath());
            $content = file_get_contents($phpFile->getRealPath());

            if (preg_match_all("/__\(['\"](.*?)['\"]\)/", $content, $matches)) {
                foreach ($matches[1] as $match) {
                    $match = stripslashes($match);
                    $this->info("Found translation: $match in file ".$phpFile->getRealPath());

                    foreach ($translatableFilePaths as $path) {
                        $translationContent = json_decode(file_get_contents($path), true, 512, JSON_THROW_ON_ERROR);

                        if (! array_key_exists($match, $translationContent)) {

                            if($this->isEnglishTranslationFile($path)){
                                $translationContent[$match] = $match;
                            }else{
                                $translationContent[$match] = '';
                            }

                            file_put_contents($path, json_encode($translationContent, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
                            $this->info("Added missing translation for '{$match}' in '{$path}'");
                        }
                    }
                }
            }
        }

        return 1;
    }

    public function isEnglishTranslationFile(string $path): bool
    {
        return str_contains($path, 'en.json');
    }

    public function getTranslatableFiles(): array
    {
        $availableCountries = config('translation.available_countries');
        $translatableFilePaths = [];

        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(config('translation.translation_files_path')));

        foreach ($availableCountries as $countryCode) {
            foreach ($iterator as $file) {

                if ($file->isDir()) {
                    continue;
                }

                $shouldExclude = false;

                foreach (config('translation.exclude_paths') as $excludePath) {
                    if (str_contains($file->getRealPath(), $excludePath)) {
                        $shouldExclude = true;
                        break;
                    }
                }

                if ($shouldExclude) {
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

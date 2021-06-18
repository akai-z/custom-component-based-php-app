<?php

declare(strict_types=1);

namespace CustomComponentApp\Framework\Config;

class FileReader
{
    const CONFIG_PATH = 'etc';
    const CONFIG_FILE_EXTENSION = 'yaml';

    public function read(string $file): string
    {
        return file_get_contents($this->filePath($file));
    }

    private function filePath(string $file): string
    {
        return dirname(__DIR__) . '/' . self::CONFIG_PATH
            . '/' . $file . '.' . self::CONFIG_FILE_EXTENSION;
    }
}

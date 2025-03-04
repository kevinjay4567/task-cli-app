<?php

readonly class Database
{
    function __construct(private string $json_path) {}

    public function all()
    {
        if (!file_exists($this->json_path)) {
            touch($this->json_path);
            file_put_contents($this->json_path, '[]');
        }

        $file = fopen($this->json_path, "r");
        $json = '';

        if ($file) {
            while (($line = fgets($file)) !== false) {
                $json = $json . $line;
            }

            fclose($file);
        } else echo 'ERROR: Error de lectura de archivo Json!';

        return $json;
    }

    public function writeFile($file): void
    {
        if (!is_writable($this->json_path)) echo 'No Se encuentra el archivo Json!' . PHP_EOL;

        file_put_contents($this->json_path, $file);
    }
}

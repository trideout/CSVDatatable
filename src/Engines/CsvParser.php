<?php
namespace redcat\Engines;

class CsvParser {
    /**
     * @var array
     */
    private $contents = [];
    private $tokens = [];

    public function __construct(string $filename)
    {
        $handle = fopen($filename, 'rb');
        while(($data = fgetcsv($handle)) !== false)
        {
            $this->contents[] = $data;
        }
        fclose($handle);
    }

    public function asArray(): array
    {
        return $this->contents;
    }

    public function asJson(): string
    {
        return json_encode($this->contents);
    }

}
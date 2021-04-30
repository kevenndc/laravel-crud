<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Util;

class UploadStorage
{
    private $local;
    private $path;
    private $fileName;

    public function __construct(string $local)
    {
        $this->local = $local;
    }

    public function store(\Illuminate\Http\UploadedFile $file)
    {
        $this->fileName = Str::slug($file->getFilename());
        return $this;
    }

    private function getAvailableName

    /**
     * Make sure that will only exist one file for a model attribute (table column)
     * by deleting older records if they exist.
     *
     * @param Model $model
     * @return bool
     */
    public function uniqueFor(Model $model, string $attribute)
    {
        return true;
    }
}

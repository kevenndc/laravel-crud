<?php
namespace App\Services;

use League\Flysystem\Util;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LocalUploadStorageService
{
    private $directory;
    private $path;
    private $fileName;
    private $drive = 'local';
    private $overwriteAllowed = false;
    private $file;

    public function __construct(string $directory = 'public/storage')
    {
        $this->directory = $directory;
    }

    public function store(\Illuminate\Http\UploadedFile $file)
    {
        $this->fileName = Str::slug($file->getFilename());
        $this->file = $file;
        $this->setPath($this->fileName);
        return $this;
    }

    public function save()
    {
        if (! $this->overwriteAllowed) {
            $this->findAvailabeName();
        }
        return $this->path;
    }

    public function allowOvewrite()
    {
        $this->overwriteAllowed = true;
        if (Storage::exists($this->path)) {
            Storage::delete($this->path);
        }
        //Storage::putFileAs($)
        return true;
    }

    public function findAvailabeName(string $fileName)
    {
        $fileName = $fileName ?? $this->fileName;
        $this->setPath($fileName);

        if (Storage::exists($this->path)) {
            $fileName = $this->suffixWithNumber($fileName);
        }
        return $fileName;
    }

    private function suffixWithNumber(string $fileName)
    {
        $i = 1;
        do {
            $newName = $fileName . '-' . $i++;
            $this->setPath($newName);
        } while (Storage::exists($this->path));

        return $newName;
    }

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

    private function setPath(string $fileName)
    {
        $this->path = $this->directory . $fileName;
    }
}

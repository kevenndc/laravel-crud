<?php
namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LocalUploadStorageService
{
    private $directory;
    private $path;
    private $fileName;
    private $drive = 'local';
    private $canOverwrite = false;
    private $file;

    /**
     * LocalUploadStorageService constructor.
     * @param string $directory The storage directory tha the file should be stored.
     */
    public function __construct(string $directory = 'images')
    {
        $this->directory = $directory;
        dd($this->directory);
    }

    /**
     * Saves the file related date in the object instance.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return $this
     */
    public function store(\Illuminate\Http\UploadedFile $file)
    {
        $this->fileName = $this->makeFileName($file->getClientOriginalName());
        $this->file = $file;
        $this->setPath($this->fileName);
        return $this;
    }

    /**
     * Stores the file and returns its relative path to the 'storage' directory.
     *
     * @return false|string
     */
    public function save()
    {
        if (! $this->canOverwrite) {
            $this->fileName = $this->getAvailableName($this->fileName);
        }
        $this->path = Storage::putFileAs($this->directory, $this->file, $this->fileName);
        return $this->path;
    }

    /**
     * Deletes any files with the same name in the storage directory.
     *
     * @return $this
     */
    public function withOverwrite()
    {
        $this->canOverwrite = true;
        if (Storage::exists($this->path)) {
            Storage::delete($this->path);
        }
        return $this;
    }

    /**
     * Returns a available name for the file if one already exists in same storage directory.
     *
     * @param string $fileName
     * @return string
     */
    public function getAvailableName(string $fileName)
    {
        $fileName = $fileName ?? $this->fileName;
        if (Storage::exists($this->path)) {
            $fileName = $this->suffixWithNumber($fileName);
            $this->setPath($fileName);
        }
        return $fileName;
    }

    /**
     * Add a number at the end of the file name.
     *
     * @param string $fileName
     * @return string
     */
    private function suffixWithNumber(string $fileName)
    {
        $name = pathinfo($fileName, PATHINFO_FILENAME);
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        $i = 1;
        do {
            $newName = $name . '-' . $i++ . '.' . $extension;
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
        if ($currentValue = $model->getAttribute($attribute)) {
            dd($currentValue);
        }
        return true;
    }

    private function setPath(string $fileName)
    {
        $this->path = "{$this->directory}/{$fileName}";
    }

    private function makeFileName(string $fileName)
    {
        $name = pathinfo($fileName, PATHINFO_FILENAME);
        $name = Str::slug($name);
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        return "{$name}.{$extension}";
    }
}

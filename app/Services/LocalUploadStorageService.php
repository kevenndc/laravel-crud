<?php
namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LocalUploadStorageService implements UploadStorageService
{
    private $file;
    private $path;
    private $fileName;
    private $directory;
    private $canOverwrite = false;


    /**
     * Saves the file related date in the object instance.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return $this
     */
    public function store(\Illuminate\Http\UploadedFile $file)
    {
        $this->file = $file;
        $this->fileName = $this->makeFileName($file->getClientOriginalName());
        return $this;
    }

    /**
     * Saves the directory which the file should be saved.
     *
     * @param string $directory
     * @return $this
     */
    public function inDirectory(string $directory)
    {
        $this->directory = $directory;
        return $this;
    }

    /**
     * Stores the file and returns its relative path to the 'storage' directory.
     *
     * @return false|string
     */
    public function save()
    {
        $this->setPath($this->fileName);
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

    protected function setPath(string $fileName)
    {
        $this->path = "{$this->directory}/{$fileName}";
    }

    /**
     * Returns a available name for the file if one already exists in same storage directory.
     *
     * @param string $fileName
     * @return string
     */
    protected function getAvailableName(string $fileName)
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
    protected function suffixWithNumber(string $fileName)
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

    protected function makeFileName(string $fileName)
    {
        $name = pathinfo($fileName, PATHINFO_FILENAME);
        $name = Str::slug($name);
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        return "{$name}.{$extension}";
    }
}

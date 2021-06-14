<?php
namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

final class LocalUploadStorageService implements UploadStorageService
{
    private UploadedFile $file;
    private string $path;
    private string $fileName;
    private string $directory;
    private bool $canOverwrite = false;


    /**
     * Sets the file that should be be saved.
     *
     * @param UploadedFile $file
     * @return $this
     */
    public function store(UploadedFile $file)
    {
        $this->file = $file;
        $this->fileName = $this->makeFileName($file->getClientOriginalName());
        return $this;
    }

    /**
     * Sets the directory in which the file should be saved.
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

    private function setPath(string $fileName)
    {
        $this->path = "{$this->directory}/{$fileName}";
    }

    /**
     * Returns a available name for the file if one already exists in same storage directory.
     *
     * @param string $fileName
     * @return string
     */
    private function getAvailableName(string $fileName)
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
     * Apply the slug pattern into the file name.
     *
     * @param string $fileName
     * @return string
     */
    private function makeFileName(string $fileName)
    {
        $name = pathinfo($fileName, PATHINFO_FILENAME);
        $name = Str::slug($name);
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);
        return "{$name}.{$extension}";
    }
}

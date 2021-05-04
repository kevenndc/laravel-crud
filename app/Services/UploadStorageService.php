<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

interface UploadStorageService
{
    /**
     * Saves the file related date in the object instance.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return $this
     */
    public function store(\Illuminate\Http\UploadedFile $file);

    /**
     * Saves the directory which the file should be saved.
     *
     * @param string $directory
     * @return $this
     */
    public function inDirectory(string $directory);

    /**
     * Deletes any files with the same name in the storage directory.
     *
     * @return $this
     */
    public function withOverwrite();

    /**
     * Stores the file and returns its relative path to the driver root directory.
     *
     * @return false|string
     */
    public function save();
}

<?php

namespace App\Services;

interface UploadStorageService
{
    /**
     * Sets the file that should be be saved.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return $this
     */
    public function store(\Illuminate\Http\UploadedFile $file);

    /**
     * Sets the directory in which the file should be saved.
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

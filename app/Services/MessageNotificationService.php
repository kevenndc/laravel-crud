<?php

namespace App\Services;

interface MessageNotificationService
{
    public function showSuccess(string $message);
    public function showWarning(string $message);
    public function showError(string $message);
}

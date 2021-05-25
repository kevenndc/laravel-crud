<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;


class FlashMessagesService implements MessageNotificationService
{
    const SUCCESS = 'success-message';
    const WARNING = 'warning-message';
    const ERROR = 'error-message';

    public function showSuccess(string $message)
    {
        Session::flash('status', self::SUCCESS);
        Session::flash('message', $message);
    }

    public function showWarning(string $message)
    {
        Session::flash('status', self::WARNING);
        Session::flash('message', $message);
    }

    public function showError(string $message)
    {
        Session::flash('status', self::ERROR);
        Session::flash('message', $message);
    }
}

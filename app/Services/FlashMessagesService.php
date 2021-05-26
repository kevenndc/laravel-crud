<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;

/**
 * Stores information used to show messages throughout the app
 * via the message view partial.
 *
 * Class FlashMessagesService
 * @package App\Services
 */
final class FlashMessagesService implements MessageNotificationService
{
    const SUCCESS = 'success-message';
    const WARNING = 'warning-message';
    const ERROR = 'error-message';

    /**
     * Stores a success message in the session.
     *
     * @param string $message
     */
    public function showSuccess(string $message)
    {
        Session::flash('status', self::SUCCESS);
        Session::flash('message', $message);
    }

    /**
     * Stores a success message in the session.
     *
     * @param string $message
     */
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

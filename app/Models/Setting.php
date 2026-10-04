<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $timestamps = false;
    protected $guarded = [];

    protected $casts = [
        'tg_auto_post'        => 'boolean',
        'tg_send_confirmation'=> 'boolean',
        'web_push_enabled'    => 'boolean',
        'maintenance_mode'    => 'boolean',
    ];

    /**
     * Get decrypted SMTP password safely.
     */
    public function getSmtpPasswordDecryptedAttribute(): string
    {
        try {
            return $this->smtp_password
                ? decrypt($this->smtp_password)
                : '';
        } catch (\Exception $e) {
            return '';
        }
    }

    /**
     * Get decrypted Telegram bot token safely.
     */
    public function getTgBotTokenDecryptedAttribute(): string
    {
        try {
            return $this->tg_bot_token
                ? decrypt($this->tg_bot_token)
                : '';
        } catch (\Exception $e) {
            return '';
        }
    }

    /**
     * Get decrypted VAPID private key safely.
     */
    public function getVapidPrivateKeyDecryptedAttribute(): string
    {
        try {
            return $this->vapid_private_key
                ? decrypt($this->vapid_private_key)
                : '';
        } catch (\Exception $e) {
            return '';
        }
    }
}

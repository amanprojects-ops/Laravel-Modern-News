<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadHelper;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class SettingController
{
    /**
     * Show the main settings page (tab-based).
     */
    public function settings()
    {
        $settings = Setting::first();
        return view('admin.settings.manage-settings', compact('settings'));
    }

    // ─────────────────────────────────────────────────────────────
    // 1. WEBSITE / GENERAL SETTINGS
    // ─────────────────────────────────────────────────────────────
    public function updateGeneralSettings(Request $request)
    {
        $request->validate([
            'name'  => 'required|max:60',
            'title' => 'required|max:70',
            'url'   => 'nullable|url|max:255',
        ]);

        $settings = Setting::first();
        $settings->update([
            'name'                => $request->name,
            'title'               => $request->title,
            'url'                 => $request->url,
            'maintenance_mode'    => $request->boolean('maintenance_mode'),
            'maintenance_message' => $request->maintenance_message,
        ]);
        return back()->with('success', '✅ Website settings updated successfully.');
    }

    // ─────────────────────────────────────────────────────────────
    // 2. SEO SETTINGS
    // ─────────────────────────────────────────────────────────────
    public function updateSeoSettings(Request $request)
    {
        $request->validate([
            'about'               => 'nullable|max:500',
            'keywords'            => 'nullable|max:1000',
            'description'         => 'nullable|max:300',
            'meta_author'         => 'nullable|max:100',
            'google_analytics_id' => 'nullable|max:30',
            'google_search_console' => 'nullable|max:200',
            'robots_index'        => ['nullable', Rule::in(['index,follow','noindex,nofollow','index,nofollow','noindex,follow'])],
        ]);

        $settings = Setting::first();
        $settings->update([
            'about'                 => $request->about,
            'keywords'              => $request->keywords,
            'description'           => $request->description,
            'meta_author'           => $request->meta_author,
            'google_analytics_id'   => $request->google_analytics_id,
            'google_search_console' => $request->google_search_console,
            'robots_index'          => $request->robots_index ?? 'index,follow',
        ]);
        return back()->with('success', '✅ SEO settings updated successfully.');
    }

    // ─────────────────────────────────────────────────────────────
    // 3. LOGO & FAVICON — now stored in public/uploads/images/
    // ─────────────────────────────────────────────────────────────
    public function updateImageSettings(Request $request)
    {
        $request->validate([
            'logo'             => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'logo_dark'        => 'nullable|image|mimes:png,jpg,jpeg,svg,webp|max:2048',
            'favicon'          => 'nullable|image|mimes:png,jpg,jpeg,ico|max:512',
            'apple_touch_icon' => 'nullable|image|mimes:png,jpg,jpeg|max:512',
            'og_image'         => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'main_image'       => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        $settings = Setting::first();

        // Map: input name => [db column, folder]
        $fileFields = [
            'logo'             => ['logo',             'images'],
            'logo_dark'        => ['logo_dark',        'images'],
            'favicon'          => ['favicon',          'images'],
            'apple_touch_icon' => ['apple_touch_icon', 'images'],
            'og_image'         => ['og_image',         'images'],
            'main_image'       => ['image',            'images'],
        ];

        foreach ($fileFields as $inputName => [$dbField, $folder]) {
            if ($request->hasFile($inputName)) {
                $settings->$dbField = UploadHelper::upload(
                    $request->file($inputName),
                    $folder,
                    $settings->$dbField  // old path for auto-deletion
                );
            }
        }

        $settings->save();
        return back()->with('success', '✅ Images updated successfully.');
    }

    // ─────────────────────────────────────────────────────────────
    // 4. SOCIAL MEDIA SETTINGS
    // ─────────────────────────────────────────────────────────────
    public function updateSocialMediaSettings(Request $request)
    {
        $request->validate([
            'fbPage'    => 'nullable|url|max:255',
            'tgChannel' => 'nullable|max:255',
            'ytChannel' => 'nullable|url|max:255',
            'wpGroup'   => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'twitter'   => 'nullable|url|max:255',
            'linkedin'  => 'nullable|url|max:255',
        ]);

        $settings = Setting::first();
        $settings->update([
            'fbPage'    => $request->fbPage,
            'tgChannel' => $request->tgChannel,
            'ytChannel' => $request->ytChannel,
            'wpGroup'   => $request->wpGroup,
            'instagram' => $request->instagram,
            'twitter'   => $request->twitter,
            'linkedin'  => $request->linkedin,
        ]);
        return back()->with('success', '✅ Social media settings updated successfully.');
    }

    // ─────────────────────────────────────────────────────────────
    // 5. EMAIL SMTP SETTINGS
    // ─────────────────────────────────────────────────────────────
    public function updateSmtpSettings(Request $request)
    {
        $request->validate([
            'smtp_host'         => 'required|string|max:255',
            'smtp_port'         => 'required|integer|between:1,65535',
            'smtp_username'     => 'required|string|max:255',
            'smtp_password'     => 'nullable|string|max:255',
            'smtp_encryption'   => ['required', Rule::in(['tls', 'ssl', 'none'])],
            'mail_from_name'    => 'required|string|max:100',
            'mail_from_address' => 'required|email|max:255',
        ]);

        $settings     = Setting::first();
        $smtpPassword = $request->smtp_password
            ? encrypt($request->smtp_password)
            : $settings->smtp_password;

        $settings->update([
            'smtp_host'         => $request->smtp_host,
            'smtp_port'         => $request->smtp_port,
            'smtp_username'     => $request->smtp_username,
            'smtp_password'     => $smtpPassword,
            'smtp_encryption'   => $request->smtp_encryption,
            'mail_from_name'    => $request->mail_from_name,
            'mail_from_address' => $request->mail_from_address,
        ]);

        $this->applySmtpConfig($settings->fresh());
        return back()->with('success', '✅ SMTP settings updated successfully.');
    }

    public function testSmtp(Request $request)
    {
        $request->validate(['test_email' => 'required|email']);
        $settings = Setting::first();
        $this->applySmtpConfig($settings);

        try {
            Mail::raw('This is a test email from ' . ($settings->name ?? config('app.name')) . ' admin panel.', function ($msg) use ($request, $settings) {
                $msg->to($request->test_email)
                    ->subject('Test Email - ' . ($settings->name ?? config('app.name')))
                    ->from($settings->mail_from_address ?? config('mail.from.address'), $settings->mail_from_name ?? config('mail.from.name'));
            });
            return back()->with('success', '✅ Test email sent to ' . $request->test_email . ' successfully!');
        } catch (\Exception $e) {
            Log::error('SMTP Test Failed: ' . $e->getMessage());
            return back()->with('error', '❌ SMTP test failed: ' . $e->getMessage());
        }
    }

    private function applySmtpConfig(Setting $settings): void
    {
        if ($settings->smtp_host) {
            Config::set('mail.mailers.smtp.host',       $settings->smtp_host);
            Config::set('mail.mailers.smtp.port',       $settings->smtp_port);
            Config::set('mail.mailers.smtp.username',   $settings->smtp_username);
            Config::set('mail.mailers.smtp.password',   $settings->smtp_password_decrypted);
            Config::set('mail.mailers.smtp.encryption', $settings->smtp_encryption === 'none' ? null : $settings->smtp_encryption);
            Config::set('mail.from.address',            $settings->mail_from_address);
            Config::set('mail.from.name',               $settings->mail_from_name);
            Config::set('mail.default',                 'smtp');
        }
    }

    // ─────────────────────────────────────────────────────────────
    // 6. TELEGRAM SETTINGS
    // ─────────────────────────────────────────────────────────────
    public function updateTelegramSettings(Request $request)
    {
        $request->validate([
            'tg_group_link'    => 'nullable|max:255',
            'tg_bot_token'     => 'nullable|max:255',
            'tg_chat_id'       => 'nullable|max:100',
            'tg_admin_chat_id' => 'nullable|max:100',
        ]);

        $settings = Setting::first();
        $botToken = $request->tg_bot_token
            ? ($request->tg_bot_token !== $settings->tg_bot_token_decrypted ? encrypt($request->tg_bot_token) : $settings->tg_bot_token)
            : $settings->tg_bot_token;

        $settings->update([
            'tg_group_link'        => $request->tg_group_link,
            'tgChannel'            => $request->tg_channel,
            'tg_bot_token'         => $botToken,
            'tg_chat_id'           => $request->tg_chat_id,
            'tg_admin_chat_id'     => $request->tg_admin_chat_id,
            'tg_auto_post'         => $request->boolean('tg_auto_post'),
            'tg_send_confirmation' => $request->boolean('tg_send_confirmation'),
        ]);
        return back()->with('success', '✅ Telegram settings updated successfully.');
    }

    public function fetchTelegramBotDetails(Request $request)
    {
        $settings = Setting::first();
        $token    = $settings->tg_bot_token_decrypted;
        if (!$token) return back()->with('error', '❌ Bot token not configured.');

        try {
            $response = Http::timeout(10)->get("https://api.telegram.org/bot{$token}/getMe");
            if ($response->successful() && $response->json('ok')) {
                $botData = $response->json('result');
                $settings->update(['tg_bot_details' => json_encode($botData, JSON_PRETTY_PRINT)]);
                return back()->with('success', '✅ Bot details fetched: @' . ($botData['username'] ?? 'unknown'));
            }
            return back()->with('error', '❌ Telegram API error: ' . $response->json('description'));
        } catch (\Exception $e) {
            return back()->with('error', '❌ Connection failed: ' . $e->getMessage());
        }
    }

    public function setupTelegramWebhook(Request $request)
    {
        $request->validate(['webhook_url' => 'required|url']);
        $settings = Setting::first();
        $token    = $settings->tg_bot_token_decrypted;
        if (!$token) return back()->with('error', '❌ Bot token not configured.');

        try {
            $response = Http::timeout(10)->post("https://api.telegram.org/bot{$token}/setWebhook", [
                'url' => $request->webhook_url,
            ]);
            if ($response->successful() && $response->json('ok')) {
                $info = Http::timeout(10)->get("https://api.telegram.org/bot{$token}/getWebhookInfo")->json();
                $settings->update([
                    'tg_webhook_url'     => $request->webhook_url,
                    'tg_webhook_details' => json_encode($info['result'] ?? [], JSON_PRETTY_PRINT),
                ]);
                return back()->with('success', '✅ Webhook set: ' . $request->webhook_url);
            }
            return back()->with('error', '❌ Failed: ' . $response->json('description'));
        } catch (\Exception $e) {
            return back()->with('error', '❌ Error: ' . $e->getMessage());
        }
    }

    public function deleteTelegramWebhook()
    {
        $settings = Setting::first();
        $token    = $settings->tg_bot_token_decrypted;
        if (!$token) return back()->with('error', '❌ Bot token not configured.');

        try {
            Http::timeout(10)->post("https://api.telegram.org/bot{$token}/deleteWebhook");
            $settings->update(['tg_webhook_url' => null, 'tg_webhook_details' => null]);
            return back()->with('success', '✅ Webhook removed.');
        } catch (\Exception $e) {
            return back()->with('error', '❌ Error: ' . $e->getMessage());
        }
    }

    public function testTelegram(Request $request)
    {
        $settings = Setting::first();
        $token    = $settings->tg_bot_token_decrypted;
        $chatId   = $settings->tg_admin_chat_id;
        if (!$token || !$chatId) return back()->with('error', '❌ Bot token or admin chat ID not configured.');

        try {
            $response = Http::timeout(10)->post("https://api.telegram.org/bot{$token}/sendMessage", [
                'chat_id'    => $chatId,
                'text'       => "✅ *Test message from " . ($settings->name ?? 'News Admin') . " panel*\n\nTelegram integration is working!",
                'parse_mode' => 'Markdown',
            ]);
            if ($response->successful() && $response->json('ok')) {
                return back()->with('success', '✅ Test message sent to admin chat!');
            }
            return back()->with('error', '❌ Failed: ' . $response->json('description'));
        } catch (\Exception $e) {
            return back()->with('error', '❌ Error: ' . $e->getMessage());
        }
    }

    // ─────────────────────────────────────────────────────────────
    // 7. WEB PUSH SETTINGS
    // ─────────────────────────────────────────────────────────────
    public function updateWebPushSettings(Request $request)
    {
        $request->validate([
            'vapid_public_key'  => 'nullable|string|max:500',
            'vapid_private_key' => 'nullable|string|max:500',
            'push_app_name'     => 'nullable|string|max:100',
        ]);

        $settings     = Setting::first();
        $vapidPrivate = $request->vapid_private_key
            ? encrypt($request->vapid_private_key)
            : $settings->vapid_private_key;

        $settings->update([
            'vapid_public_key'  => $request->vapid_public_key,
            'vapid_private_key' => $vapidPrivate,
            'push_app_name'     => $request->push_app_name,
            'web_push_enabled'  => $request->boolean('web_push_enabled'),
        ]);
        return back()->with('success', '✅ Web Push settings updated successfully.');
    }

    public function generateVapidKeys()
    {
        $privateKey = openssl_pkey_new(['curve_name' => 'prime256v1', 'private_key_type' => OPENSSL_KEYTYPE_EC]);
        $details    = openssl_pkey_get_details($privateKey);
        $publicKey  = rtrim(strtr(base64_encode($details['ec']['x'] . $details['ec']['y']), '+/', '-_'), '=');
        openssl_pkey_export($privateKey, $privatePem);
        $privateKeyRaw = rtrim(strtr(base64_encode($details['ec']['d']), '+/', '-_'), '=');

        return response()->json([
            'vapid_public'  => 'BP' . $publicKey,
            'vapid_private' => $privateKeyRaw,
            'message'       => 'Keys generated. Copy and save securely.',
        ]);
    }
}

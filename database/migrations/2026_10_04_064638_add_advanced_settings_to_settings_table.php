<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            // SEO Settings
            $table->string('meta_author')->nullable()->after('description');
            $table->string('google_analytics_id')->nullable()->after('meta_author');
            $table->string('google_search_console')->nullable()->after('google_analytics_id');
            $table->string('canonical_url')->nullable()->after('google_search_console');
            $table->enum('robots_index', ['index,follow', 'noindex,nofollow', 'index,nofollow', 'noindex,follow'])->default('index,follow')->after('canonical_url');

            // Logo & Favicon (already exist: logo, favicon, image — but we add more)
            $table->string('logo_dark')->nullable()->after('robots_index');
            $table->string('apple_touch_icon')->nullable()->after('logo_dark');
            $table->string('og_image')->nullable()->after('apple_touch_icon');

            // Email SMTP Settings
            $table->string('smtp_host')->nullable()->after('og_image');
            $table->integer('smtp_port')->nullable()->after('smtp_host');
            $table->string('smtp_username')->nullable()->after('smtp_port');
            $table->string('smtp_password')->nullable()->after('smtp_username');
            $table->enum('smtp_encryption', ['tls', 'ssl', 'none'])->default('tls')->after('smtp_password');
            $table->string('mail_from_name')->nullable()->after('smtp_encryption');
            $table->string('mail_from_address')->nullable()->after('mail_from_name');

            // Telegram Settings
            $table->string('tg_group_link')->nullable()->after('mail_from_address');
            $table->string('tg_bot_token')->nullable()->after('tg_group_link');
            $table->string('tg_chat_id')->nullable()->after('tg_bot_token');
            $table->string('tg_webhook_url')->nullable()->after('tg_chat_id');
            $table->boolean('tg_auto_post')->default(false)->after('tg_webhook_url');
            $table->boolean('tg_send_confirmation')->default(false)->after('tg_auto_post');
            $table->string('tg_admin_chat_id')->nullable()->after('tg_send_confirmation');
            $table->text('tg_bot_details')->nullable()->after('tg_admin_chat_id');
            $table->text('tg_webhook_details')->nullable()->after('tg_bot_details');

            // Web Push Settings
            $table->string('vapid_public_key')->nullable()->after('tg_webhook_details');
            $table->string('vapid_private_key')->nullable()->after('vapid_public_key');
            $table->string('push_app_name')->nullable()->after('vapid_private_key');
            $table->boolean('web_push_enabled')->default(false)->after('push_app_name');

            // Website Status & Maintenance
            $table->boolean('maintenance_mode')->default(false)->after('web_push_enabled');
            $table->text('maintenance_message')->nullable()->after('maintenance_mode');

            // Social Media (additional)
            $table->string('instagram')->nullable()->after('maintenance_message');
            $table->string('twitter')->nullable()->after('instagram');
            $table->string('linkedin')->nullable()->after('twitter');
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'meta_author', 'google_analytics_id', 'google_search_console',
                'canonical_url', 'robots_index', 'logo_dark', 'apple_touch_icon', 'og_image',
                'smtp_host', 'smtp_port', 'smtp_username', 'smtp_password', 'smtp_encryption',
                'mail_from_name', 'mail_from_address',
                'tg_group_link', 'tg_bot_token', 'tg_chat_id', 'tg_webhook_url',
                'tg_auto_post', 'tg_send_confirmation', 'tg_admin_chat_id',
                'tg_bot_details', 'tg_webhook_details',
                'vapid_public_key', 'vapid_private_key', 'push_app_name', 'web_push_enabled',
                'maintenance_mode', 'maintenance_message',
                'instagram', 'twitter', 'linkedin',
            ]);
        });
    }
};

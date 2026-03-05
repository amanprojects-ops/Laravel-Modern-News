## 🔹 Step 1: PHP Path Check (Hostinger Specific)

Hostinger pe shared hosting me PHP binary path hota hai:

```
/usr/bin/php
```

✅ Is path ko cron job command me use karna hoga.

---

## 🔹 Step 2: Laravel Scheduler Cron Job

Laravel ke **scheduler** ko chalane ke liye ek hi cron job sufficient hai.
hPanel → **Advanced → Cron Jobs** → Add Cron Job.

Command (example):

```bash
* * * * * /usr/bin/php /home/u123456789/apply2home.com/artisan schedule:run >> /dev/null 2>&1
```

* `* * * * *` → har minute chalega
* `/home/u123456789/apply2home.com/` → **aapke Laravel project ka root path** (Hostinger file manager me `public_html` se upar ka path check karke confirm karein)
* `>> /dev/null 2>&1` → output ko ignore kar dega (log file bloat nahi hogi)

---

## 🔹 Step 3: Queue Worker Scheduler Me Add Karna

Laravel 11 me `app/Console/Kernel.php` open karo aur:

```php
protected function schedule(Schedule $schedule): void
{
    // Process pending jobs (emails, notifications, etc.)
    $schedule->command('queue:work --stop-when-empty')->everyMinute();
}
```

👉 Isse aapke background jobs (emails, notifications) automatic process honge.

---

## 🔹 Step 4: Database Queue Setup (Emails ke liye Recommended)

1. `.env` update karo:

   ```env
   QUEUE_CONNECTION=database
   ```
2. Tables create karo:

   ```bash
   php artisan queue:table
   php artisan migrate
   ```
3. Email bhejte waqt:

   ```php
   Mail::to($email)->queue(new SandEmail($message, $subject));
   ```

👉 Ab emails queue me jayenge aur cron job unhe background me process karega.

---

## 🔹 Step 5: Alternative (Agar artisan direct run na ho)

Agar Hostinger me artisan command cron job me chalti nahi hai, to ek **secure route** banao:

```php
use Illuminate\Support\Facades\Artisan;

Route::get('/run-cron/{token}', function ($token) {
    if ($token !== env('CRON_SECRET')) {
        abort(403);
    }
    Artisan::call('schedule:run');
    return "Cron executed at " . now();
});
```

`.env` me:

```env
CRON_SECRET=apply2home_secret
```

Fir cron job set karo:

```bash
* * * * * curl -s https://apply2home.com/run-cron/apply2home_secret > /dev/null 2>&1
```

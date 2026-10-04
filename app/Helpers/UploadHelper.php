<?php

namespace App\Helpers;

use Illuminate\Http\UploadedFile;

class UploadHelper
{
    /**
     * Upload a file to public/uploads/{folder}/ and return the relative path.
     * Relative path format: "uploads/{folder}/{filename}"
     * Access via: asset('uploads/{folder}/{filename}')
     *
     * @param  UploadedFile  $file
     * @param  string        $folder   e.g. 'images', 'post_images', 'attachments'
     * @param  string|null   $oldPath  Relative path of old file to delete (optional)
     * @return string
     */
    public static function upload(UploadedFile $file, string $folder, ?string $oldPath = null): string
    {
        // Ensure directory exists
        $dir = public_path("uploads/{$folder}");
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        // Delete old file if provided
        if ($oldPath) {
            $oldFullPath = public_path($oldPath);
            if (file_exists($oldFullPath)) {
                @unlink($oldFullPath);
            }
        }

        // Generate unique filename
        $extension = $file->getClientOriginalExtension();
        $filename  = bin2hex(random_bytes(8)) . '.' . $extension;

        // Move to public/uploads/{folder}/
        $file->move($dir, $filename);

        return "uploads/{$folder}/{$filename}";
    }

    /**
     * Delete a file from public/ by its relative path.
     *
     * @param  string|null  $relativePath  e.g. 'uploads/images/abc.png'
     * @return bool
     */
    public static function delete(?string $relativePath): bool
    {
        if (!$relativePath) return false;
        $fullPath = public_path($relativePath);
        if (file_exists($fullPath)) {
            return @unlink($fullPath);
        }
        return false;
    }

    /**
     * Return full asset URL for a file stored in public/uploads.
     * Handles both old "images/xxx" style paths and new "uploads/images/xxx" paths.
     *
     * @param  string|null  $path
     * @return string|null
     */
    public static function url(?string $path): ?string
    {
        if (!$path) return null;
        // Already a full uploads/ path
        if (str_starts_with($path, 'uploads/')) {
            return asset($path);
        }
        // Old storage-style path like "images/xxx.png" or "post_images/xxx.jpg"
        return asset('uploads/' . $path);
    }
}

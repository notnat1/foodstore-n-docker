<?php

use Illuminate\Support\Facades\Storage;

if (! function_exists('imageUrl')) {
    /**
     * Generate the URL for an image based on the default filesystem disk.
     * * @param string|null $path Path relative to the storage disk root (e.g., 'uploads/image.jpg').
     * @return string|null The full URL to the image, or null if path is empty.
     */
    function imageUrl(?string $path): ?string
    {
        if (empty($path)) {
            return null; // Atau return URL placeholder default
        }

        // Ambil disk default dari config (yang dibaca dari .env FILESYSTEM_DISK)
        $defaultDisk = config('filesystems.default');

        if ($defaultDisk === 's3') {
            // Jika pakai S3, gunakan Storage::url()
            return Storage::disk('s3')->url($path);
        } else {
            // Jika pakai local atau disk lain yang di-link ke public/storage
            // Pastikan path TIDAK dimulai dengan '/'
            $publicPath = ltrim($path, '/');
            return asset('storage/' . $publicPath);
        }
    }
}

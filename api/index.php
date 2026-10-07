<?php

// Ensure writable directories in Vercel's ephemeral /tmp storage
$dirs = [
    '/tmp/storage/framework/views',
    '/tmp/storage/framework/cache/data',
    '/tmp/storage/framework/sessions',
    '/tmp/storage/logs',
    '/tmp/bootstrap/cache',
    '/tmp/database',
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Copy seed SQLite database to /tmp if using sqlite
$sourceSqlite = __DIR__ . '/../database/seed.sqlite';
$targetSqlite = '/tmp/database/database.sqlite';
if (!file_exists($targetSqlite)) {
    if (file_exists($sourceSqlite)) {
        copy($sourceSqlite, $targetSqlite);
    } else {
        touch($targetSqlite);
    }
}

// Forward to Laravel public/index.php
require __DIR__ . '/../public/index.php';

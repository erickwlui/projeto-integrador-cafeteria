<?php

if (!function_exists('require_admin_auth')) {
    function require_admin_auth(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (empty($_SESSION['admin_id'])) {
            $basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');
            if ($basePath === '.' || $basePath === DIRECTORY_SEPARATOR || $basePath === '') {
                $basePath = '';
            }

            $loginPath = $basePath . '/admin/login.php';
            header('Location: ' . $loginPath);
            exit;
        }
    }
}
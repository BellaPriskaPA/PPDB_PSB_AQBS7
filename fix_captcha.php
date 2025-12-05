<?php
// Fix CAPTCHA refresh URL in beranda.php
$filePath = 'beranda.php';
$content = file_get_contents($filePath);

// Replace incorrect CAPTCHA URL format
$content = str_replace(
    "securimage/securimage_show.php?' + Math.random()",
    "securimage/securimage_show.php?t=' + Math.random()",
    $content
);

file_put_contents($filePath, $content);
echo "CAPTCHA URLs fixed successfully!\n";
?>

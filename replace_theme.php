<?php
$files = array_merge(
    glob('resources/views/admin/*.blade.php') ?: [], 
    glob('resources/views/layouts/admin/*.blade.php') ?: []
);

foreach ($files as $file) {
    $content = file_get_contents($file);
    $content = str_replace('emerald-', 'admin-', $content);
    file_put_contents($file, $content);
}
echo "Done replacing emerald- with admin-\n";

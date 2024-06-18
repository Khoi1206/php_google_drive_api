<?php
require 'vendor/autoload.php';

use GoogleDriveSync\GoogleDriveSync;

// Đường dẫn tới tệp JSON chứa thông tin dịch vụ tài khoản
$serviceAccountPath = 'lib-googledrive-api.json';

$googleDriveSync = new GoogleDriveSync($serviceAccountPath);

// Đường dẫn tới tệp cần đồng bộ
$filePath = 'D:/Code/Honeynet/lib-upload-file/test.txt';

// Thực hiện upload file
$uploadedFile = $googleDriveSync->uploadFile($filePath);

echo "File uploaded successfully. File ID: " . $uploadedFile->id . "\n";

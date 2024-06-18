<?php

namespace GoogleDriveSync;

use Google\Client;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;

class GoogleDriveSync
{
  private $client;
  private $driveService;

  public function __construct($serviceAccountPath)
  {
    $this->client = new Client();
    $this->client->setAuthConfig($serviceAccountPath);
    $this->client->addScope(Drive::DRIVE_FILE);
    $this->driveService = new Drive($this->client);
  }

  public function uploadFile($filePath, $driveFolderId = null)
  {
    $fileName = basename($filePath);
    $file = new DriveFile();
    $file->setName($fileName);

    if ($driveFolderId) {
      $file->setParents([$driveFolderId]);
    }

    $data = file_get_contents($filePath);
    $createdFile = $this->driveService->files->create($file, [
      'data' => $data,
      'mimeType' => mime_content_type($filePath),
      'uploadType' => 'multipart',
      'fields' => 'id' // Chỉ định rõ ràng các trường bạn muốn nhận về
    ]);

    return $createdFile;
  }
}

<?php

abstract class AbstractEntityManager
{
    protected $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    protected function uploadImageToCloudinary($image)
    {
        if (!isset($image) || !is_array($image) || $image['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        if (!in_array($image['type'], $allowedTypes)) {
            return false;
        }

        $uploadData = array(
            'file' => new CURLFile($image['tmp_name'], $image['type'], $image['name']),
            'upload_preset' => 'unsigned',
            'cloud_name' => CLOUDINARY_CLOUD_NAME
        );

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => CLOUDINARY_URL,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $uploadData,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 30
        ));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);

        if ($error) {
            error_log("Cloudinary upload cURL error: " . $error);
            return false;
        }

        if ($httpCode !== 200) {
            error_log("Cloudinary upload HTTP error: " . $httpCode);
            return false;
        }

        $data = json_decode($response, true);
        if (!$data || !isset($data['secure_url'])) {
            error_log("Cloudinary upload invalid response: " . $response);
            return false;
        }

        return $data['secure_url'];
    }

    protected function deleteImageFromCloudinary($imageUrl)
    {
        $public_id = pathinfo(basename($imageUrl), PATHINFO_FILENAME);
        if (!$public_id) {
            return false;
        }

        $apiUrl = "https://api.cloudinary.com/v1_1/" . CLOUDINARY_CLOUD_NAME . "/image/destroy";
        $timestamp = time();
        $paramsToSign = "public_id={$public_id}&timestamp={$timestamp}" . CLOUDINARY_SECRET;
        $signature = sha1($paramsToSign);

        $postData = array(
            'public_id' => $public_id,
            'api_key' => CLOUDINARY_API_KEY,
            'timestamp' => $timestamp,
            'signature' => $signature
        );

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $apiUrl,
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_TIMEOUT => 30
        ));

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);

        if ($error) {
            error_log("Cloudinary delete cURL error: " . $error);
            return false;
        }

        if ($httpCode !== 200) {
            error_log("Cloudinary delete HTTP error: " . $httpCode);
            return false;
        }

        $data = json_decode($response, true);
        if (!$data || !isset($data['result']) || $data['result'] !== 'ok') {
            error_log("Cloudinary delete invalid response: " . $response);
            return false;
        }

        return true;
    }
}
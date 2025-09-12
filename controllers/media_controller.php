<?php
require_once MODEL_PATH . '/../models/Media.php';

class media_controller
{
    public function showForm()
    {
        $type = $_POST['type'] ?? '';
        $errors = [];
        $success = "";

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $type) {
            $data = $_POST;
            $image = $_FILES['image'] ?? null;

            $media = new Media($type, $data, $image);
            $result = $media->uploadImage();
            $errors = $result['errors'];
            $success = $result['success'];
        }

        // Inclure la vue
        require __DIR__ . '/../views/mediaForm.php';
    }
}

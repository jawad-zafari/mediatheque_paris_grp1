<?php
require_once MODEL_PATH . '/../models/Media.php';

class media_controller
{
    private function render($view, $data = []) {
        extract($data);
        require __DIR__ . '/../views/' . $view . '.php';
    }
//bankaiiiiiiiiiiiiiiiiii
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
            $errors = $result['errors'] ?? [];
            $success = $result['success'] ?? '';

            // Affichage de l'image uploadée si succès
            if ($success && isset($result['filename'])) {
                $success .= '<br><img src="/uploads/covers/' . htmlspecialchars($result['filename']) . '" style="max-width:300px;max-height:400px;">';
            }
        }

        $this->render('mediaForm', [
            'type' => $type,
            'errors' => $errors,
            'success' => $success
        ]);
    }
}

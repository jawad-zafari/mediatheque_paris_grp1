<?php
require_once MODEL_PATH . '/../models/Media.php';

class media_controller
{
    private function render($view, $data = []) {
    extract($data); // transforme les clés du tableau en variables
    require __DIR__ . '/../views/' . $view . '.php';
}

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

    // 🔹 Appel de la vue avec les variables
    $this->render('mediaForm', [
        'type' => $type,
        'errors' => $errors,
        'success' => $success
    ]);
}
}

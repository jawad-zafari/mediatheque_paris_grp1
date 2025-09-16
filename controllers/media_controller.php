<?php
/*require_once MODEL_PATH . '/../models/Media.php';

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
}*/
function home_media_upload() {
    $data = [
        'title' => 'Accueil',
        'message' => 'Bienvenue sur votre application PHP MVC !',
        'features' => [
            'Architecture MVC claire',
            'Système de routing simple',
            'Templating HTML/CSS',
            'Gestion de base de données',
            'Sécurité intégrée'
        ]
    ];
    
    load_view_with_layout('home/media_upload', $data);
}

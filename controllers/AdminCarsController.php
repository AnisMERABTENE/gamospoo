<?php


class AdminCarsController
{
    private $adminCarsRepository;

    public function __construct($dbh)
    {
        $this->adminCarsRepository = new AdminCarsRepository($dbh);
    }

    public function home()
    {
        $cars = $this->adminCarsRepository->getAllCars();
        require __DIR__ . '/../views/admin_cars.php';
    }

    public function page()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $action = $_POST['action'] ?? '';

            if (!in_array($action, ['add', 'delete', 'edit'], true)) {
                die("Action non autorisée."); // Sécurisation contre les actions non valides
            }

            if ($action === 'add') {
                $this->handleAddCar();
            } elseif ($action === 'delete' && isset($_POST['car_id'])) {
                $this->handleDeleteCar((int) $_POST['car_id']);
            } elseif ($action === 'edit' && isset($_POST['car_id'])) {
                $this->handleEditCar((int) $_POST['car_id']);
            }

            // Redirection après action
            header('Location: /adminCars/home');
            exit;
        }
    }

    private function handleAddCar()
    {
        $marque = htmlspecialchars($_POST['marque'] ?? '', ENT_QUOTES, 'UTF-8');
        $prix = filter_var($_POST['prix'], FILTER_VALIDATE_FLOAT);

        if (!$marque || !$prix) {
            die("Les champs 'marque' et 'prix' sont requis et doivent être valides.");
        }

        $image = $_FILES['image'] ?? null;

        if ($image && $image['error'] === UPLOAD_ERR_OK) {
            $imagePath = $this->uploadImage($image);

            $car = new CarModel();
            $car->setMarque($marque)
                ->setPrix($prix)
                ->setImagePath($imagePath);

            $this->adminCarsRepository->addCar($car);
        } else {
            die("Erreur lors de l'upload de l'image.");
        }
    }

    private function handleDeleteCar(int $carId)
    {
        if ($carId <= 0) {
            die("ID de voiture invalide.");
        }

        $this->adminCarsRepository->deleteCar($carId);
    }

    private function handleEditCar(int $carId)
    {
        if ($carId <= 0) {
            die("ID de voiture invalide.");
        }

        $marque = htmlspecialchars($_POST['marque'] ?? '', ENT_QUOTES, 'UTF-8');
        $prix = filter_var($_POST['prix'], FILTER_VALIDATE_FLOAT);

        if (!$marque || !$prix) {
            die("Les champs 'marque' et 'prix' sont requis et doivent être valides.");
        }

        $image = $_FILES['image'] ?? null;

        $car = new CarModel();
        $car->setId($carId)
            ->setMarque($marque)
            ->setPrix($prix);

        if ($image && $image['error'] === UPLOAD_ERR_OK) {
            $imagePath = $this->uploadImage($image);
            $car->setImagePath($imagePath);
        } else {
            $car->setImagePath(htmlspecialchars($_POST['current_image_path'] ?? '', ENT_QUOTES, 'UTF-8'));
        }

        $this->adminCarsRepository->editCar($car);
    }

    private function uploadImage($image)
    {
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $targetDir = __DIR__ . '/../uploads/';

        // Sécurisation du nom de fichier
        $fileName = basename($image['name']);
        $fileName = preg_replace('/[^a-zA-Z0-9-_\.]/', '', $fileName);

        // Vérifier l'extension
        $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (!in_array($extension, $allowedExtensions, true)) {
            die("Extension de fichier non autorisée.");
        }

        $targetFile = $targetDir . $fileName;

        // Vérifier la taille du fichier (limite de 5 Mo)
        if ($image['size'] > 5 * 1024 * 1024) {
            die("Le fichier est trop volumineux.");
        }

        // Déplacer le fichier uploadé
        if (!move_uploaded_file($image['tmp_name'], $targetFile)) {
            die("Erreur lors de l'upload du fichier.");
        }

        return '/uploads/' . $fileName;
    }
}

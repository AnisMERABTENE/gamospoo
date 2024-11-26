<?php
/*
class AdminController
{
    private $adminRepository;

    public function __construct($dbh)
    {
        $this->adminRepository = new AdminRepository($dbh);
    }

    // Méthode pour afficher la page d'administration
    public function home()
    {
        // Récupérer les utilisateurs normaux
        $users = $this->adminRepository->getNormalUsers();

        // Récupérer les administrateurs
        $admins = $this->adminRepository->getAdminUsers();

        // Inclure la vue d'administration
        require 'views/admin.php';
    }

    // Méthode pour gérer la modification et la suppression des utilisateurs
    public function page()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['action'], $_POST['user_id'])) {
                $userId = (int)$_POST['user_id'];
                $action = $_POST['action'];

                if ($action === 'delete') {
                    // Supprimer l'utilisateur
                    $result = $this->adminRepository->deleteUser($userId);
                    if ($result) {
                        $_SESSION['message'] = "Utilisateur supprimé avec succès.";
                    } else {
                        $_SESSION['error'] = "Échec de la suppression de l'utilisateur.";
                    }
                } elseif ($action === 'change_role' && isset($_POST['new_role'])) {
                    // Modifier le rôle de l'utilisateur
                    $newRole = $_POST['new_role'];
                    $result = $this->adminRepository->updateUserRole($userId, $newRole);
                    if ($result) {
                        $_SESSION['message'] = "Rôle de l'utilisateur mis à jour avec succès.";
                    } else {
                        $_SESSION['error'] = "Échec de la mise à jour du rôle de l'utilisateur.";
                    }
                }
            }
        }

        // Rediriger vers la page d'administration
        header('Location: /Admin/home');
        exit;
    }
}
    */

class AdminController
{
    private $adminRepository;

    public function __construct($dbh)
    {
        $this->adminRepository = new AdminRepository($dbh);
    }

    // Méthode pour afficher la page d'administration
    public function home()
    {
        try {
            // Récupérer les utilisateurs normaux
            $users = $this->adminRepository->getNormalUsers();

            // Récupérer les administrateurs
            $admins = $this->adminRepository->getAdminUsers();

            // Inclure la vue d'administration
            require 'views/admin.php';
        } catch (Exception $e) {
            $_SESSION['error'] = "Une erreur est survenue lors du chargement des utilisateurs.";
            header('Location: /Admin/home');
            exit;
        }
    }

    // Méthode pour gérer la modification et la suppression des utilisateurs
    public function page()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['action'], $_POST['user_id'])) {
                $_SESSION['error'] = "Données invalides soumises.";
                header('Location: /Admin/home');
                exit;
            }

            $userId = filter_var($_POST['user_id'], FILTER_VALIDATE_INT);
            $action = htmlspecialchars($_POST['action'], ENT_QUOTES, 'UTF-8');

            if ($userId === false || $userId <= 0) {
                $_SESSION['error'] = "ID utilisateur invalide.";
                header('Location: /Admin/home');
                exit;
            }

            try {
                if ($action === 'delete') {
                    // Supprimer l'utilisateur
                    $result = $this->adminRepository->deleteUser($userId);
                    if ($result) {
                        $_SESSION['message'] = "Utilisateur supprimé avec succès.";
                    } else {
                        $_SESSION['error'] = "Échec de la suppression de l'utilisateur.";
                    }
                } elseif ($action === 'change_role' && isset($_POST['new_role'])) {
                    // Modifier le rôle de l'utilisateur
                    $newRole = htmlspecialchars($_POST['new_role'], ENT_QUOTES, 'UTF-8');

                    // Vérifier que le rôle est valide
                    if (!in_array($newRole, ['admin', 'utilisateur'], true)) {
                        $_SESSION['error'] = "Rôle utilisateur non valide.";
                        header('Location: /Admin/home');
                        exit;
                    }

                    $result = $this->adminRepository->updateUserRole($userId, $newRole);
                    if ($result) {
                        $_SESSION['message'] = "Rôle de l'utilisateur mis à jour avec succès.";
                    } else {
                        $_SESSION['error'] = "Échec de la mise à jour du rôle de l'utilisateur.";
                    }
                } else {
                    $_SESSION['error'] = "Action non valide.";
                }
            } catch (Exception $e) {
                $_SESSION['error'] = "Une erreur est survenue : " . $e->getMessage();
            }
        } else {
            $_SESSION['error'] = "Requête invalide.";
        }

        // Rediriger vers la page d'administration
        header('Location: /Admin/home');
        exit;
    }
}


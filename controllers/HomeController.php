<?php

class HomeController
{
    public function home()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        require 'views/home.php';
    }

    public function handleForm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                $this->logError('CSRF token invalide ou manquant.');
                $_SESSION['error'] = 'Une erreur est survenue. Veuillez réessayer.';
                header('Location: /Home');
                exit;
            }

            $start_date = filter_input(INPUT_POST, 'start_date', FILTER_SANITIZE_STRING);
            $end_date = filter_input(INPUT_POST, 'end_date', FILTER_SANITIZE_STRING);

            if ($this->validateDate($start_date) && $this->validateDate($end_date)) {
                if (strtotime($start_date) <= strtotime($end_date)) {
                    $_SESSION['start_date'] = htmlspecialchars($start_date, ENT_QUOTES, 'UTF-8');
                    $_SESSION['end_date'] = htmlspecialchars($end_date, ENT_QUOTES, 'UTF-8');

                    header('Location: /cars', true, 302);
                    exit;
                } else {
                    $this->logError('La date de début est postérieure à la date de fin.');
                    $_SESSION['error'] = 'La date de début doit être antérieure ou égale à la date de fin.';
                }
            } else {
                $this->logError('Validation échouée pour les dates.');
                $_SESSION['error'] = 'Les dates saisies ne sont pas valides.';
            }

            header('Location: /Home');
            exit;
        } else {
            $this->home();
        }
    }

    private function validateDate(string $date): bool
    {
        $date_regex = '/^\d{4}-\d{2}-\d{2}$/';
        if (!preg_match($date_regex, $date)) {
            return false;
        }

        $date_parts = explode('-', $date);
        return checkdate((int)$date_parts[1], (int)$date_parts[2], (int)$date_parts[0]);
    }

    private function logError(string $message): void
    {
        $log_message = '[' . date('Y-m-d H:i:s') . '] ' . $message . PHP_EOL;
        file_put_contents(__DIR__ . '/../logs/error.log', $log_message, FILE_APPEND);
    }
}
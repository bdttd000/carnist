<?php

require_once 'AppController.php';
require_once 'SessionController.php';
require_once __DIR__ . '/../models/Car.php';
require_once __DIR__ . '/../models/CarInfo.php';
require_once __DIR__ . '/../repository/CarRepository.php';
require_once __DIR__ . '/../repository/UserRepository.php';

class CarController extends AppController
{
    const MAX_FILE_SIZE = 1024 * 1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/uploads/';
    private static $messages = [];
    private $carRepository;
    private $userRepository;
    private $sessionController;

    public function __construct()
    {
        parent::__construct();
        $this->carRepository = new CarRepository();
        $this->userRepository = new UserRepository();
        $this->sessionController = new SessionController();
    }

    public function car($query = '')
    {
        if ($query == '') {
            $userInfo = $this->sessionController->unserializeUser();
            $userCity = $userInfo->getUserInfo()->getCityId();
            $query = strval($userCity);
        }

        parse_str($query, $query);
        $carId = intval($query['id']);

        $car = $this->carRepository->getCarById($carId);
        $owner = $this->userRepository->getUserById($car->getUserId());

        $this->render('car', ['car' => $car, 'owner' => $owner]);
    }

    public function addCar()
    {

        $this->render('addCar');
    }

    public function getCarById($carId)
    {
        return $this->carRepository->getCarById($carId);
    }

    public function getCars($cityId)
    {
        return $this->carRepository->getCarsByCity($cityId);
    }

    public function addCarForm()
    {
        if (
            !(
                $this->isPost()
                && is_uploaded_file($_FILES['avatar']['tmp_name'])
                && $this->validateFile($_FILES['avatar'])
                && $this->validateTitle($_POST['title'])
            )
        ) {
            return $this->redirectToHome();
        }

        $folderName = $this->carRepository->generateID();
        $newPath = dirname(__DIR__) . self::UPLOAD_DIRECTORY . $folderName;
        mkdir($newPath);

        $avatarUrl = $this->carRepository->generateID() . '.' . pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);

        move_uploaded_file(
            $_FILES['avatar']['tmp_name'],
            $newPath . '/' . $avatarUrl
        );

        $photos = [];
        if ($_FILES['photos']) {
            for ($i = 0; $i < count($_FILES['photos']['name']); $i++) {
                $tmp_name = $_FILES['photos']['tmp_name'][$i];
                $ext = pathinfo($_FILES['photos']['name'][$i], PATHINFO_EXTENSION);
                $newName = $this->carRepository->generateID() . '.' . $ext;

                move_uploaded_file(
                    $tmp_name,
                    $newPath . '/' . $newName
                );

                array_push($photos, $newName);
            }
        }

        $this->carRepository->addCar(
            $_POST['title'],
            $_POST['description'],
            intval($_POST['city']),
            $folderName,
            $avatarUrl,
            $photos
        );

        return $this->redirectToHome();
    }

    private function validateFile(array $file): bool
    {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            array_push(self::$messages, 'Plik jest za duży');
            return false;
        }

        if (!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)) {
            array_push(self::$messages, 'Rozszerzenie pliku jest niedozwolone');
            return false;
        }

        return true;
    }

    private function validateTitle(string $title): bool
    {
        if (strlen($title) < 3) {
            array_push(self::$messages, 'Nazwa jest za krótka');
            return false;
        }

        if (strlen($title) > 50) {
            array_push(self::$messages, 'Nazwa jest za długa');
            return false;
        }

        return true;
    }
}
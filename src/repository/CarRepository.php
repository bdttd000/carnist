<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Car.php';
require_once __DIR__ . '/../models/CarInfo.php';
require_once __DIR__ . '/../controllers/SessionController.php';

class CarRepository extends Repository
{
    private $sessionController;

    public function __construct()
    {
        parent::__construct();
        $this->sessionController = new SessionController();
    }
    public function getCarsByCity(string $cityId): ?array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT c.*, ci.name, ci.description, ci.directory_url, ci.avatar_url, city.city_id, city.name city_name
            FROM car c
            JOIN car_info ci ON c.car_info_id = ci.car_info_id
            JOIN car_city cc ON c.car_id = cc.car_id
            JOIN city ON cc.city_id = city.city_id
            WHERE city.city_id= :cityId
            ORDER BY c.car_id DESC
        ');
        $stmt->bindParam(':cityId', $cityId, PDO::PARAM_INT);
        $stmt->execute();

        $cars = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (!$cars) {
            return null;
        }

        $output = [];

        foreach ($cars as $car) {
            $photos = $this->getPhotosByCarInfoId(intval($car['car_info_id']));

            $carInfo = new CarInfo(
                $car['car_info_id'],
                $car['name'],
                $car['description'],
                $car['directory_url'],
                $car['avatar_url'],
                $photos
            );

            $newCar = new Car(
                $car['car_id'],
                $car['user_id'],
                $car['car_info_id'],
                $car['active'],
                $car['creation_date'],
                $carInfo,
                $car['city_id'],
                $car['city_name']
            );

            array_push($output, $newCar);
        }

        return $output;
    }

    public function getCarById(string $carId): ?Car
    {
        $stmt = $this->database->connect()->prepare('
            SELECT c.*, ci.name, ci.description, ci.directory_url, ci.avatar_url, city.city_id, city.name city_name
            FROM car c
            JOIN car_info ci ON c.car_info_id = ci.car_info_id
            JOIN car_city cc ON c.car_id = cc.car_id
            JOIN city ON cc.city_id = city.city_id
            WHERE c.car_id = :carId
        ');
        $stmt->bindParam(':carId', $carId, PDO::PARAM_INT);
        $stmt->execute();

        $car = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$car) {
            return null;
        }

        $photos = $this->getPhotosByCarInfoId(intval($car['car_info_id']));

        $carInfo = new CarInfo(
            $car['car_info_id'],
            $car['name'],
            $car['description'],
            $car['directory_url'],
            $car['avatar_url'],
            $photos
        );

        return new Car(
            $car['car_id'],
            $car['user_id'],
            $car['car_info_id'],
            $car['active'],
            $car['creation_date'],
            $carInfo,
            $car['city_id'],
            $car['city_name']
        );
    }

    public function getPhotosByCarInfoId(int $carInfoId): array
    {
        $output = [];

        $stmt = $this->database->connect()->prepare('
            SELECT photo_id, photo_url 
            FROM photos 
            WHERE car_info_id = :carInfoId
        ');
        $stmt->bindParam(':carInfoId', $carInfoId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCar(string $name, string $description, int $cityId, string $directoryUrl, string $avatarUrl, array $photos): void
    {
        $carId = $this->getNextId('car', 'car_id');
        $carInfoId = $this->getNextId('car_info', 'car_info_id');
        $userId = $this->sessionController->unserializeUser()->getUserID();
        $creationDate = new DateTime();

        $stmt = $this->database->connect()->prepare('
            INSERT INTO car (car_id, user_id, car_info_id, active, creation_date) VALUES (?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $carId,
            $userId,
            $carInfoId,
            true,
            $creationDate->format('Y-m-d')
        ]);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO car_info (car_info_id, name, description, directory_url, avatar_url) VALUES (?, ?, ?, ?, ?)
        ');

        $stmt->execute([
            $carInfoId,
            $name,
            $description,
            $directoryUrl,
            $avatarUrl
        ]);

        $stmt = $this->database->connect()->prepare('
            INSERT INTO car_city (car_id, city_id) VALUES (?, ?)
        ');

        $stmt->execute([
            $carId,
            $cityId
        ]);

        foreach ($photos as $photo) {
            $photoId = $this->getNextId('photos', 'photo_id');
            $stmt = $this->database->connect()->prepare('
                INSERT INTO photos (photo_id, car_info_id, photo_url) VALUES (?, ?, ?)
            ');

            $stmt->execute([
                $photoId,
                $carInfoId,
                $photo
            ]);
        }
    }
}
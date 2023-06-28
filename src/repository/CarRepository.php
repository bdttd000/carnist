<?php

require_once 'Repository.php';
require_once __DIR__ . '/../models/Car.php';
require_once __DIR__ . '/../models/CarInfo.php';

class CarRepository extends Repository
{
    public function getCarsByCity(string $cityId): ?array
    {
        $stmt = $this->database->connect()->prepare('
            SELECT c.*, ci.name, ci.description, ci.directory_url, ci.avatar_url, city.city_id, city.name city_name
            FROM car c
            JOIN car_info ci ON c.car_info_id = ci.car_info_id
            JOIN car_city cc ON c.car_id = cc.car_id
            JOIN city ON cc.city_id = city.city_id
            WHERE city.city_id= :cityId
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
}
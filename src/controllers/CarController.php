<?php

require_once 'AppController.php';
require_once 'SessionController.php';
require_once __DIR__ . '/../models/Car.php';
require_once __DIR__ . '/../models/CarInfo.php';
require_once __DIR__ . '/../repository/CarRepository.php';

class CarController extends AppController
{
    private $carRepository;
    private $sessionController;

    public function __construct()
    {
        parent::__construct();
        $this->carRepository = new CarRepository();
        $this->sessionController = new SessionController();
    }

    public function home($query = '')
    {
        if ($query == '') {
            $userInfo = $this->sessionController->unserializeUser();
            $userCity = $userInfo->getUserInfo()->getCityId();
            $query = strval($userCity);
        }

        parse_str($query, $query);
        // $page = intval($query['page']);
        // $evaluated = 1;

        // $memes = $this->memeRepository->getMemes($page, $this->memesPerPage, $evaluated);
        // $ads = $this->adRepository->getAds(5);
        // $pagesCount = ceil($this->memeRepository->memesCount($evaluated) / $this->memesPerPage);
        $this->render('home');
    }

    public function getCars()
    {
        return $this->carRepository->getCarsByCity(1);
    }
}
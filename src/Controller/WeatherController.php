<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\LocationRepository;
use App\Repository\MeasurementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class WeatherController extends AbstractController
{
    #[Route(
        '/weather/{city}/{country}',
        name: 'app_weather',
        defaults: ['country' => null]
    )]
    #[Route(
        '/weather/{city}',
        name: 'app_weather_city'
    )]
    public function city(
        string $city,
        LocationRepository $locationRepository,
        MeasurementRepository $measurementRepository,
        ?string $country = null
    ): Response {
        $criteria = ['city' => $city];

        if ($country !== null) {
            $criteria['country'] = $country;
        }

        $location = $locationRepository->findOneBy($criteria);

        if (!$location) {
            throw $this->createNotFoundException(
                'Location not found.'
            );
        }

        $measurements = $measurementRepository->findByLocation($location);

        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $measurements,
        ]);
    }
}

<?php

namespace App\Repositories\Contracts;

interface TourRepositoryInterface
{
    public function updateTour(array $data, $id);
    public function deleteTour(array $data, $id);
    public function createNewTour(array $data);
    public function getAllTours(int $limit, int $offset);
    public function getTourById(int $id);
}

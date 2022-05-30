<?php
/**
 * This class has only the responsability
 * of query our resources from database
 */

namespace App\Repositories;

use App\Models\Tour;
use App\Repositories\Contracts\TourRepositoryInterface;

class TourRepository implements TourRepositoryInterface
{

    protected $entity;

    public function __construct(Tour $tour)
    {
        $this->entity = $tour;
    }

    public function getAllTours(int $limit, $offset)
    {
        return $this->entity->paginate($limit)->skip($offset);
    }

    public function getTourById($id)
    {
        return $this->entity->where('id', $id)->first();
    }

    public function createNewTour(array $data)
    {
        return $this->entity->create($data);
    }

    public function updateTour(array $data, $id)
    {
       $this->entity->where('id', $id)->update($data);

       return   $this->entity->where('id', $id)->first() ;
    }

    public function deleteTour(array $data, $id)
    {
       $this->entity->where('id', $id)->delete($data);

       return   $this->entity->where('id', $id)->first() ;
    }
}

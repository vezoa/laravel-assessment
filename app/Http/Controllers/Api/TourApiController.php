<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\storeUpdateTour;
use App\Http\Resources\TourResource;
use App\Models\Tour;
use App\Services\TourService;
use Illuminate\Http\Request;

class TourApiController extends Controller
{

    protected $tourService;

    public function __construct(TourService $tourService )
    {
        $this->tourService = $tourService;
    }
    /**
     * Display all tour dates.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {



            if($request->price) {

                if( $price = $request->price['eq'] ) {
                    $getFomated = Tour::where('price',  $price)->get();
                    return  $getFomated;
               }
               elseif($price = $request->price['lte']){
                   $getFomated = Tour::where('price', '<=', $price)->get();
                   return  $getFomated;
               }
               elseif($price = $request->price['gte']){
                   $getFomated = Tour::where('price', '>=', $price)->get();
                   return  $getFomated;
               }
            }

            $dateStart = $request->start;
            $dateEnd = $request->end;

            if($dateStart || $dateEnd ) {
                        if($dateStart = $request->start['eq'] ?? ""
                        || $dateEnd = $request->end['eq'] ?? ""){

                            $getFomated = Tour::where('start',  $dateStart)
                                                -> orWhere('end',$dateEnd )
                                                ->get();
                            return  $getFomated;
                        }
                        elseif($dateStart = $request->start['lte'] ?? ""
                            || $dateEnd = $request->end['lte'] ?? "") {
                                $getFomated = Tour::where('start', '<=', $dateStart)
                                -> orWhere('end', '<=', $dateEnd )
                                ->get();
                            return  $getFomated;

                            }

                            elseif($dateStart = $request->start['gte'] ?? ""
                            || $dateEnd = $request->end['gte'] ?? "" ) {
                                $getFomated = Tour::where('start', '>=', $dateStart)
                                -> orWhere('end', '>=', $dateEnd )
                                ->get();
                            return  $getFomated;

                            }
            }

       $limit = $request->get('limit', 15);//allow pagination, if none param passed assume 15 as default
       $offset = $request->get('offset', 1);//allow offset, if none param passed assume 2 as default
        $tours = $this->tourService->getAllTours($limit, $offset);

        return TourResource::collection($tours);
    }


    /**
     * Store a Tour in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeUpdateTour $request)
    {
        $tour = $this->tourService->createNewTour($request->all());

        return new TourResource($tour);
    }

    /**
     * Display the specified tour.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tour = $this->tourService->getTourById($id);
        // dd($tour);
        if(!$tour = $this->tourService->getTourById($id)){
            return response()->json(['message' => 'Not found '], 404);
        }

        return new TourResource($tour);
    }


    /**
     * Update the specified a specific tour.
     *
     */
    public function update(storeUpdateTour $request, $id)
    {

        $data = $request->all();

        $tour = $this->tourService->updateTour($data, $id);



        return new TourResource($tour);
    }

    /**
     * Remove the specified tour from storage.
     *
     */
    public function destroy(Request $request, $id)
    {

        $data = $request->all();

        $tour = $this->tourService->deleteTour($data, $id);

        if(!$tour)
         return response()->json(['message' => 'Tour deleted '], 200);
    }
}

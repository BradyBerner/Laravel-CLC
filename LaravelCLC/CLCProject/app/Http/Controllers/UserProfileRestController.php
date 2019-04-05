<?php

namespace App\Http\Controllers;

use App\Models\DTO;
use App\Services\Utility\ILoggerService;
use App\Services\Utility\ViewData;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserProfileRestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return json_encode(new DTO(501, "Not Implemented", null));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return json_encode(new DTO(501, "Not Implemented", null));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        return json_encode(new DTO(501, "Not Implemented", null));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, ILoggerService $logger)
    {
        $logger->info("Entering UserProfileRestController.show()", []);

        try{
            $profile = ViewData::getProfileData($id, $logger);

            //TODO:: Finish Logic

        } catch (\Exception $e){
            $logger->error("Error in UserProfileRestController.show()", [$e->getMessage()]);
            return json_encode(new DTO(500, "Internal Server Error", null));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return json_encode(new DTO(501, "Not Implemented", null));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        return json_encode(new DTO(501, "Not Implemented", null));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return json_encode(new DTO(501, "Not Implemented", null));
    }
}

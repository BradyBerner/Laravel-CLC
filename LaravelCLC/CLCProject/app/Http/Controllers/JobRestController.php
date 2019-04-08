<?php

namespace App\Http\Controllers;

use App\Models\DTO;
use App\Services\Business\JobService;
use App\Services\Utility\ILoggerService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JobRestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param ILoggerService $logger
     * @return Response
     */
    public function index(ILoggerService $logger)
    {
        $logger->info("Entering JobRestController.index()", []);

        try{
            $service = new JobService();

            $job = $service->getAllJobs($logger);

            if($job != null){
                if(count($job) <= 100) {
                    $dto = new DTO(200, "OK", $job);
                } else {
                    $dto = new DTO(206, "There were too many results so only the first 100 have been returned",
                        array_slice($job, 0, 100));
                }
            } else {
                $dto = new DTO(204, "No Content", null);
            }

            $logger->info("Exiting JobRestController.index()", []);

            return json_encode($dto);
        } catch (Exception $e){
            $logger->error("Error in JobRestController.index()", [$e]);
            return json_encode(new DTO(500, "Internal Server Error", null));
        }
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
     * @param int $id
     * @param ILoggerService $logger
     * @return Response
     */
    public function show($id, ILoggerService $logger)
    {
        $logger->info("Entering JobRestController.show()", []);

        try{
            $service = new JobService();

            $job = $service->getJob($id, $logger)['job'];

            if($job != null){
                $dto = new DTO(200, "OK", $job);
            } else {
                $dto = new DTO(204, "No Content", null);
            }

            $logger->info("Exiting JobRestController.show()", []);

            return json_encode($dto);
        } catch (Exception $e){
            $logger->error("Error in JobRestController.show()", null);
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

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ApiIntedrationDestroyRequest;
use App\Http\Requests\ApiIntegrationCreateRequest;
use App\Http\Requests\ApiIntegrationUpdateRequest;
use App\Services\IntegrationService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use \Illuminate\Database\Eloquent\Collection;

class IntegrationController extends Controller
{
    public IntegrationService $integrationService;

    public function __construct(IntegrationService $integrationService)
    {
        $this->integrationService = $integrationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return array|\Illuminate\Database\Eloquent\Collection
     */
    public function index(): Collection|array
    {
        return $this->integrationService->getAll();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApiIntegrationCreateRequest $request)
    {
        $data = $request->only('marketplace', 'username', 'password');

        $result = $this->integrationService->create($data);

        return response()
            ->json()
            ->setData($result)
            ->setStatusCode(200)
            ->setCharset('utf-8')
            ->header('Content-Type', 'application/json')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ApiIntegrationUpdateRequest $request, int $id)
    {
        $data = $request->only('marketplace', 'username', 'password');

        $result = $this->integrationService->updateById($id, $data);
        return response()
            ->json()
            ->setData($result)
            ->setStatusCode(200)
            ->setCharset('utf-8')
            ->header('Content-Type', 'application/json')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ApiIntedrationDestroyRequest $request, int $id)
    {
        $result = $this->integrationService->deleteById($id);

        return response()->json()
            ->setData($result)
            ->setStatusCode(200)
            ->setCharset('utf-8')
            ->header('Content-Type', 'application/javascript')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }
}

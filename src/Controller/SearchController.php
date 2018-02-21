<?php

namespace App\Controller;

use App\Search\SearchHandler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchController
{
    /**
     * @var SearchHandler
     */
    private $searchHandler;

    /**
     * @param SearchHandler $searchHandler
     */
    public function __construct(SearchHandler $searchHandler)
    {
        $this->searchHandler = $searchHandler;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request)
    {
        try {
            $keyword = $request->query->get('keyword');

            $results = $this->searchHandler->search($keyword);

            $response = new JsonResponse($results);
            $response->setEncodingOptions(JSON_PRETTY_PRINT);

            return $response;
        } catch (\Exception $exception) {
            return $this->createErrorResponse($exception);
        }
    }

    /**
     * @param \Exception $exception
     * @return JsonResponse
     */
    private function createErrorResponse(\Exception $exception)
    {
        $status = $exception->getCode() ? $exception->getCode() : Response::HTTP_INTERNAL_SERVER_ERROR;

        return new JsonResponse([
            'error' => [
                'status'  => $status,
                'message' => $exception->getMessage(),
            ]
        ], $status);
    }
}

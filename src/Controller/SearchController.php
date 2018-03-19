<?php

namespace App\Controller;

use App\Search\Searcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SearchController
{
    /**
     * @var Searcher
     */
    private $searcher;

    public function __construct(Searcher $searcher)
    {
        $this->searcher = $searcher;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function search(Request $request)
    {
        try {
            $keyword = $request->query->get('keyword');

            $searchResult = $this->searcher->search($keyword);

            $response = new JsonResponse($searchResult);
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

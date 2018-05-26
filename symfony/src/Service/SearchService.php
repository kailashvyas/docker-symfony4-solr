<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

/**
 * SearchService - search service to get results from solr.
 */
class SearchService
{
    const LIMIT = 10;

    /**
     * Api Service
     *
     * @var ApiService
     */
    private $apiService;

    /**
     * Constructor.
     *
     * @param ApiService $apiService ApiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * CreateFilterParams - build filter params for solr request.
     *
     * @param Request $request Request Object
     *
     * @return array
     */
    public function createFilterParams(Request $request)
    {
        $page = $request->query->get('page', 1);
        $params['q'] = $request->query->get('q', '*.*');
        $params['start'] = (1 == $page) ? 0 : (($page - 1) * 10 + 1);
        $params['rows'] = self::LIMIT;

        return $params;
    }

    /**
     * GetSearchResults - get search Results via solr request using apiService.
     *
     * @param Request $request Request Object
     *
     * @return array
     */
    public function getSearchResults(Request $request)
    {
        $params = $this->createFilterParams($request);
        $listing = $this->apiService->getApiResponse('search_definition', $params);

        return $listing;
    }
}

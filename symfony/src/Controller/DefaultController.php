<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Service\SearchService;

/**
 * DefaultController.
 */
class DefaultController extends Controller
{
    /**
     * Index
     *
     * @param Request       $request
     * @param SearchService $searchService
     *
     * @return Response
     */
    public function index(Request $request, SearchService $searchService)
    {
        $listing = $searchService->getSearchResults($request);

        return $this->render(
            'default/index.html.twig',
            [
              'listing' => $listing,
              'currentPage' => $request->query->get('page', 1),
            ]
        );
    }
}

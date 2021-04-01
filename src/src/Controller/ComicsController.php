<?php

namespace App\Controller;

use App\Controller\Traits\MakeItValidated;
use App\Fetcher\FetcherPreparer;
use App\Service\Contracts\ComicsServiceContract;
use App\Validator\ComicsIndexValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComicsController extends AbstractController
{
    use MakeItValidated;

    /**
     * @Route("/comics", name="comics")
     * @param Request $request
     * @param ComicsServiceContract $comicsService
     * @param FetcherPreparer $fetcherPreparer
     * @return Response
     */
    public function index(Request $request, ComicsServiceContract $comicsService, FetcherPreparer $fetcherPreparer)
    {
        $validator = new ComicsIndexValidator();
        $this->validate($validator, $request);
        return new JsonResponse($comicsService->getComics($fetcherPreparer->handle($request->query->all())));
    }
}

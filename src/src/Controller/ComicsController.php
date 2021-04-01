<?php

namespace App\Controller;

use App\Controller\Traits\MakeItValidated;
use App\Fetcher\FetcherPreparer;
use App\Service\Contracts\ComicsServiceContract;
use App\Validator\ComicsIndexValidator;
use OpenApi\Annotations\Parameter;
use OpenApi\Annotations\Schema;
use OpenApi\Annotations\Tag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ComicsController extends AbstractController
{
    use MakeItValidated;

    /**
     * Lists the comics from different sources
     *
     * @Route("/api/comics", name="comics", methods={"GET"})
     * @param Request $request
     * @param ComicsServiceContract $comicsService
     * @param FetcherPreparer $fetcherPreparer
     * @return Response
     *
     *
     * @\OpenApi\Annotations\Response(
     *     response="200",
     *     description="Successful"
     * )
     *
     * @\OpenApi\Annotations\Response(
     *     response="422",
     *     description="Validation Error"
     * )
     *
     * @Parameter(
     *     name="xkcd_length",
     *     in="query",
     *     description="Number of comics demanded from Xkcd",
     *     @Schema(
     *          type="integer"
     *      )
     * )
     *
     * @Parameter(
     *     name="poorly_drawn_lines_length",
     *     in="query",
     *     description="Number of comics demanded from poorly_drawn_lines_length",
     *     @Schema(
     *          type="integer"
     *      )
     * )
     *
     * @Tag(
     *     name="Comics"
     * )
     */
    public function index(Request $request, ComicsServiceContract $comicsService, FetcherPreparer $fetcherPreparer)
    {
        $validator = new ComicsIndexValidator();
        $this->validate($validator, $request);
        return new JsonResponse($comicsService->getComics($fetcherPreparer->handle($request->query->all())));
    }
}

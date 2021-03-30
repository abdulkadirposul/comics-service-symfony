<?php

namespace App\Controller;

use App\Controller\Traits\MakeItValidated;
use App\Validator\ComicsIndexValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComicsController extends AbstractController
{
    use MakeItValidated;

    /**
     * @Route("/comics", name="comics")
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        $validator = new ComicsIndexValidator();
        $this->responseAsInvalid($validator, $request);

        return new Response("111");
    }
}

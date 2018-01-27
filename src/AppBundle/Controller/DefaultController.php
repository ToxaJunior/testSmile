<?php

namespace AppBundle\Controller;

use AppBundle\Entity\WarehouseProducts;
use AppBundle\Service\ImportService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $availableProducts = $this->getDoctrine()->getRepository(WarehouseProducts::class)->getAvailable();
        return $this->render('AppBundle::index.html.twig', ['availableProducts' => $availableProducts]);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Route("/import", name="import")
     */
    public function importAction(Request $request)
    {
        try{
            $this->get(ImportService::class)->import($request->files->get('import_csv'));
        }
        catch (\Exception $e){
            return $this->render('AppBundle::index.html.twig', ['error' => $e->getMessage()]);
        }

        return $this->redirectToRoute('homepage');
    }
}

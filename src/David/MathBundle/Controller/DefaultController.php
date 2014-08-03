<?php

namespace David\MathBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($page)
    {
        $em = $this->get('doctrine')->getManager();
        $query = $em->createQuery('SELECT COUNT(c.id) FROM DavidMathBundle:Card c');
        $total = $query->getSingleScalarResult();
        $data = array();
        $data["page"] = $page;
        $data["perPage"] = 12;
        $data["totalNumPages"] = ceil($total/$data["perPage"]);
        $data["offset"] = 0;
        if($page > 1)
            $data["offset"] = $data["perPage"] * ($page-1);
        if(28 <= $data["perPage"])
            $page = 1;
        if($page*$data["perPage"] > $total)
            $page = $data["totalNumPages"];
        $qry = $em->createQueryBuilder()
            ->select('c')
            ->from('DavidMathBundle:Card', 'c')
            ->setFirstResult($data["offset"])
            ->setMaxResults($data["perPage"]);
        $data["cards"] = $qry->getQuery()->getArrayResult();
        return $this->render('DavidMathBundle:Default:index.html.twig', $data);
    }
}

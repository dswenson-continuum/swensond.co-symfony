<?php

namespace David\MathBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class DefaultController extends Controller
{
    public function indexAction($page)
    {
        $handcount = 0;
        $fieldcount = 0;
        $turn = 1;
        $save = false;
        if(!$this->get('session')->isStarted()){
            $session = new Session();
            $session->start();
        }else{
            $session = $this->get('session');
            $handcount =  $session->getFlashBag()->get('hand');
            if($handcount != null)
                $handcount = (int)$handcount[0]-1;
            $fieldcount = $session->getFlashBag()->get('field');
            if($fieldcount != null)
                $fieldcount = (int)$fieldcount[0]-1;
            $turn = $session->getFlashBag()->get('turn');
            if($turn != null)
                $turn = (int)$turn[0];
            $save = $session->getFlashBag()->get('save');
            if($save != null){
                if($save[0] == "false")
                    $save = false;
                else
                    $save = true;
            }
        }
        if($turn != 1 && $save === true){
            $session->getFlashBag()->add('hand', $handcount);
            $session->getFlashBag()->add('field', $fieldcount);
            $session->getFlashBag()->add('turn', $turn);
            $session->getFlashBag()->add('save', "false");
            return $this->redirect($this->generateUrl('_view_deck',array('page' => $turn)));
        }
        $em = $this->get('doctrine')->getManager();
        $query = $em->createQuery('SELECT COUNT(c.id) FROM DavidMathBundle:Card c');
        $total = $query->getSingleScalarResult();
        $data = array();
        $data["page"] = $page;
        $data["perPage"] = 12;
        $data["totalNumPages"] = ceil($total/$data["perPage"]);
        $data["offset"] = 0;
        if($page+3 > 6)
            $hand = 6;
        else
            $hand = $page+3;
        if((int)$handcount+(int)$fieldcount >= 5)
            $hand = (int)$handcount+(int)$fieldcount+2;
        if($handcount == -1)
            $hand = (int)$fieldcount+1;
        if($handcount == -1 && $fieldcount == -1)
            $hand = 4;
        $this->get('logger')->info($hand);
        $this->get('logger')->info((int)$handcount+(int)$fieldcount);
        //if($page > 1)
        //    $data["offset"] = $data["perPage"] * ($page-1);
        if($total <= $data["perPage"])
            $page = 1;
        //->setFirstResult(mt_rand(0,$total-$hand)) add to line 74-75 to break hand
        $qry = $em->createQueryBuilder()
            ->select('c')
            ->from('DavidMathBundle:Card', 'c')
            ->setMaxResults($hand);
        $data["cards"] = $qry->getQuery()->getArrayResult();
        $data["resource"] = $page;
        if($page > 10)
            $data["resource"] = 10;
        return $this->render('DavidMathBundle:Default:field.html.twig', $data);
    }
    public function handAction(Request $request){
        if(!$this->get('session')->isStarted()){
            $session = new Session();
            $session->start();
        }else{
            $session = $this->get('session');
        }
        $hand = $request->request->get('hand');
        $field = $request->request->get('field');
        $turn = $request->request->get('turn');
        $save = $request->request->get('save');
        $session->getFlashBag()->add('hand', $hand);
        $session->getFlashBag()->add('field', $field);
        $session->getFlashBag()->add('turn', $turn);
        $session->getFlashBag()->add('save', $save);
        return new Response('good');
    }
}

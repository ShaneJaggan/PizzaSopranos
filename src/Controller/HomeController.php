<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Pizza;
use App\Entity\PizzaOrder;
use App\Entity\Size;
use App\Form\PizzaFormType;
use App\Repository\PizzaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/pizza/{category}", name="app_pizza")
     */
    public function pizza(Category $category, PizzaRepository $pizzaRepository){
        $pizza = $pizzaRepository->findBy(['category' => $category]);

        return $this->render('pages/pizza.html.twig',[
            'pizza' => $pizza,
        ]);
    }
    /**
     * @Route("/", name="app_homepage")
     */
    public function homepage(EntityManagerInterface $em){
        $repository = $em->getRepository(Category::class);
        /**
         * @var Category $cat
         */
        $cat = $repository->findAll();
        return $this->render('pages/homepage.html.twig',[
            'categories'=> $cat,
        ]);
    }

    /**
     * @Route("/orderPizza/{pizza}", name="app_orderPizza")
     */
    public function pizzaOrder(EntityManagerInterface $em, Request $request, Pizza $pizza){
        $pizzaName = $pizza->getName();
        $repository = $em->getRepository(Size::class);
        /**
         * @var Size $size
         */
        $form = $this->createForm(PizzaFormType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();
            $size = $repository->find($data['size_id']);

            $pizzaOrder = new PizzaOrder();
            $pizzaOrder->setFname($data['fname']);
            $pizzaOrder->setSname($data['sname']);
            $pizzaOrder->setCity($data['city']);
            $pizzaOrder->setAdress($data['adress']);
            $pizzaOrder->setZipcode($data['zipcode']);
            $pizzaOrder->setPizza($pizza);
            $pizzaOrder->setSize($size);

            $em->persist($pizzaOrder);
            $em->flush();

            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('pages/order.html.twig',[
            'pizza'=>$pizza,
            'pizzaForm'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/viewOrders", name="app_viewOrder")
     */
    public function viewOrders(EntityManagerInterface $em){
        $repository = $em->getRepository(PizzaOrder::class);
        /**
         * @var PizzaOrder $orders
         */
        $orders = $repository->findAll();
        return $this->render('pages/viewOrders.html.twig',[
            'orders'=>$orders,
        ]);
    }
}
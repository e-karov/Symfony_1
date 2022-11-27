<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test', name: 'app_test')]
    public function index(): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    #[Route('/random/{num}', name:"random_number")]
    public function randomNumber($num): Response
    {
        $result = random_int(0, $num);
        return $this->render("test/random.html.twig", ["randomNumber"=>$result]);
    }

    #[Route("test-var", name:"var")]
    public function testVar()
    {
        $arr = array("name"=>"serri", "age"=>30);
        return $this->render("test/test_var.html.twig", array("varName"=>$arr));
    }

    #[Route("/hello-world", name:"hello_world_page")]
    public function testAction()
    {
        $text = "Hello world!";
        return $this->render("test/hello_world.html.twig", ["text"=>$text]);
    }

    #[Route("/child", name:"child_page")]
    public function childAction()
    {
        return $this->render("test/child.html.twig");
    }

}

<?php

namespace OC\LoginBundle\Controller;

use OC\LoginBundle\Entity\Advert;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class AdvertController extends Controller
{
    public function addAction(Request $request)
    {

        // On crée un objet Advert
        $advert = new Advert();


        // On crée le FormBuilder grâce au service form factory
        $formBuilder = $this->get('form.factory')->createBuilder(FormType::class);

        $formBuilder
            ->add('Pseudo',    TextType::class)
            ->add('Password',     TextType::class)
            ->add('Connection',      SubmitType::class)
        ;
        // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard

        // À partir du formBuilder, on génère le formulaire
        $form = $formBuilder->getForm();

        // On passe la méthode createView() du formulaire à la vue
        // afin qu'elle puisse afficher le formulaire toute seule

        if ($request->getMethod() == 'POST') {
                $post = $_POST['form'];

                $repository = $this->getDoctrine()->getRepository('OCLoginBundle:Advert');
                $product = $repository->findOneByPseudo($post['Pseudo']);
                $test = $product->getPassword();


                if ($post['Password']==$test){
                    return $this->render('OCLoginBundle:Default:index.html.twig');
                }
                else {
                    return $this->render('OCLoginBundle:Advert:add.html.twig', array(
                        'form' => $form->createView(),));
                }

        }

        return $this->render('OCLoginBundle:Advert:add.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
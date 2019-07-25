<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
    
    /**
     * @Route("/mail", name="mail")
     */
    public function mail(MailerInterface $mailer)
    {
        $email = new \Symfony\Component\Mime\Email();
        $email->from("contacto@carosanti.cl")
                ->to("prueba@hardcybersoft.cl")
                ->subject("Prueba con Sendgrid")
                ->text("Lorem ipsum dolor")
                ->html("<strong>Lorem</strong> ipsum dolor");
        $mailer->send($email);
        $mensaje = "Se ha enviado correctamente el correo para restablecer su contraseña";
        return $this->render('index/index.html.twig', [
            'controller_name'   => 'IndexController',
            'mensaje'           => $mensaje
        ]);
    }
    
    /**
     * @Route("/mail-template", name="mail_template")
     */
    public function mailTemplate(MailerInterface $mailer)
    {
        $email = new \Symfony\Bridge\Twig\Mime\TemplatedEmail();
        $email->from("contacto@carosanti.cl")
                ->to("prueba@hardcybersoft.cl")
                ->addTo("hardcybersoft@gmail.com")
                ->subject("Prueba con Sendgrid")
                // path a Twig Template
                ->htmlTemplate('emails/signup.html.twig')
                ->context([
                    'nombre'        => 'Juanito Los Palotes',
                    'verificar_en'  => 'http://www.verificamicorreo.cl/sadfklsxl123'    
                ]);
        $mailer->send($email);
        $mensaje = "Se ha enviado correctamente el correo de bienvenida";
        return $this->render('index/index.html.twig', [
            'controller_name'   => 'IndexController',
            'mensaje'           => $mensaje
        ]);
    }
    
    
}

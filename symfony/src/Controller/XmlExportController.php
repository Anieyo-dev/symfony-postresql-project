<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;

class XmlExportController extends AbstractController
{
    #[Route('/v1/xml/export', name: 'xml_export')]
    public function export(Environment $twig): Response
    {
        // 1. Renderujesz Twiga ze statycznymi lub dynamicznymi danymi
        $xmlContent = $twig->render('xml/raports/main.xml.twig', [
            'data' => 'Cokolwiek - testowy XML',
        ]);

        // 2. Zwracasz odpowiedź z nagłówkiem XML wymuszającym pobranie pliku
        return new Response($xmlContent, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="raport.xml"',
        ]);
    }
}
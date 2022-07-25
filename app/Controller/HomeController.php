<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Controller;

use ContentioSdk\Attribute\Template;
use ContentioSdk\Component\AssetLoader;
use ContentioSdk\Component\StdTemplate;
use ContentioSdk\Component\Thumbnail\ThumbGen;
use ContentioSdk\Debugger\ApiDebugger;
use Latte\Engine;
use Strategio\Controller\Base\BaseController;
use Strategio\Model\ContactDataset;
use Strategio\Model\NavbarDataset;
use Strategio\Model\TestimonialDataset;
use Strategio\Model\WhyUsDataset;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGenerator;

class HomeController extends BaseController
{
    public function __construct(
        protected Engine             $latte,
        protected ApiDebugger        $apiDebugger,
        protected Response           $response,
        protected AssetLoader        $assetLoader,
        protected ThumbGen           $thumbGen,
        protected UrlGenerator       $urlGenerator,
        protected StdTemplate        $template,
        public Request               $request,
        
        protected ContactDataset     $contactDataset,
        protected NavbarDataset      $navbarDataset,
        protected WhyUsDataset       $whyUsDataset,
        
        protected TestimonialDataset $testimonialDataset,
    )
    {
    }
    
    #[Template(path: __DIR__ . '/../../view/controller/home.latte')]
    public function index(): void
    {
        $this->template->testimonials = $this->testimonialDataset;
        $this->template->services = [];
        $this->template->references = [];
        
        $this->addRequest('services', 'POST', "article/show-all", [
            'json' => [
                'currentPage' => 1,
                'itemsPerPage' => 100,
                'desc' => false,
                'labels' => ['sluzby'],
                'suppressLabels' => true,
                'suppressFiles' => false,
                'suppressParagraphs' => true,
                'suppressParagraphFiles' => true,
            ]
        ]);
        
        $this->addRequest('references', 'POST', "article/show-all", [
            'json' => [
                'currentPage' => 1,
                'itemsPerPage' => 3,
                'desc' => true,
                'labels' => ['reference'],
                'suppressLabels' => true,
                'suppressFiles' => false,
                'suppressParagraphs' => true,
                'suppressParagraphFiles' => true,
            ]
        ]);
        
        $responses = $this->dispatchRequests('Homepage');
        
        if ($responses['services']->getStatusCode() === Response::HTTP_OK) {
            $contents = $responses['services']->getBody()->getContents();
            $this->template->services = json_decode($contents, true)['items'];
        }
        
        if ($responses['references']->getStatusCode() === Response::HTTP_OK) {
            $contents = $responses['references']->getBody()->getContents();
            $this->template->references = json_decode($contents, true)['items'];
        }
    }
}
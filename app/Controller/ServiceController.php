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
use Strategio\Model\FaqDataset;
use Strategio\Model\NavbarDataset;
use Strategio\Model\RevisionDataset;
use Strategio\Model\TestimonialDataset;
use Strategio\Model\WhyUsDataset;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGenerator;

class ServiceController extends BaseController
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
        protected RevisionDataset    $revisionDataset,
        protected FaqDataset         $faqDataset,
    )
    {
    }
    
    public function startup(): void
    {
        parent::startup();
        
        $this->addRequest('contact_members', 'POST', "article/show-all", [
            'json' => [
                'currentPage' => 1,
                'itemsPerPage' => 2,
                'desc' => false,
                'labels' => ['kontakty-servis'],
                'suppressLabels' => true,
                'suppressFiles' => false,
                'suppressParagraphs' => true,
                'suppressParagraphFiles' => true,
            ]
        ]);
        
        $responses = $this->dispatchRequests('Contact/Member List');
        $response = $responses['contact_members'];
        $contents = $response->getBody()->getContents();
        
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            $this->renderError($response, $contents);
        }
        
        $this->template->data = json_decode($contents, true);
        $this->template->testimonials = $this->testimonialDataset;
        $this->template->faq = $this->faqDataset;
    }
    
    #[Template(path: __DIR__ . '/../../view/controller/service/emergency.latte')]
    public function emergency(): void
    {
    }
    
    #[Template(path: __DIR__ . '/../../view/controller/service/revisions.latte')]
    public function revisions(): void
    {
        $this->template->revisions = $this->revisionDataset;
    }
}
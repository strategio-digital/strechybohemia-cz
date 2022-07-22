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
use Strategio\Model\MembersDataset;
use Strategio\Model\NavbarDataset;
use Strategio\Model\RevisionDataset;
use Strategio\Model\TestimonialDataset;
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
        
        protected TestimonialDataset $testimonialDataset,
        protected RevisionDataset    $revisionDataset,
        protected MembersDataset     $membersDataset,
        protected FaqDataset         $faqDataset,
    )
    {
    }
    
    public function startup(): void
    {
        parent::startup();
        
        $this->template->testimonials = $this->testimonialDataset;
        $this->template->members = $this->membersDataset;
        $this->template->faq = $this->faqDataset;
        
        $this->template->envs = json_encode(array_merge((array)json_decode($this->template->envs, true), [
            'OLD_API_URL' => $_ENV['OLD_API_URL']
        ]));
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
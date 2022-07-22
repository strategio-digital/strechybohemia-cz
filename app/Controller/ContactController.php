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
use Strategio\Model\MembersDataset;
use Strategio\Model\NavbarDataset;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGenerator;

class ContactController extends BaseController
{
    public function __construct(
        protected Engine         $latte,
        protected ApiDebugger    $apiDebugger,
        protected Response       $response,
        protected AssetLoader    $assetLoader,
        protected ThumbGen       $thumbGen,
        protected UrlGenerator   $urlGenerator,
        protected StdTemplate    $template,
        public Request           $request,

        protected ContactDataset $contactDataset,
        protected NavbarDataset $navbarDataset,
        
        protected MembersDataset $membersDataset
    )
    {
    }
    
    #[Template(path: __DIR__ . '/../../view/controller/contact.latte')]
    public function index(): void
    {
        $this->template->members = $this->membersDataset;
    }
}
<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Controller\Base;

use ContentioSdk\Component\AssetLoader;
use ContentioSdk\Component\StdTemplate;
use ContentioSdk\Component\Thumbnail\ThumbGen;
use ContentioSdk\Debugger\ApiDebugger;
use Latte\Engine;
use Strategio\Helper\NavbarHelper;
use Strategio\Model\ContactDataset;
use Strategio\Model\NavbarDataset;
use Strategio\Model\WhyUsDataset;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGenerator;

abstract class BaseController extends \ContentioSdk\Controller\Base\BaseController
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
        protected NavbarDataset  $navbarDataset,
        protected WhyUsDataset   $whyUsDataset
    )
    {
    }
    
    public function startup(): void
    {
        parent::startup();
        
        $primaryHost = 'https://www.strechybohemia.cz';
    
        $map = [
            '/havarijni' => $this->link('service_emergency'),
            '/pravidelny' => $this->link('service_revisions'),
            '/obchod' => $this->link('home')
        ];
    
        $uri = $this->request->getRequestUri();
        $host = $this->request->getHost();
    
        if (array_key_exists($uri, $map)) {
            $this->redirect($primaryHost . $map[$uri], Response::HTTP_MOVED_PERMANENTLY);
        }
    
        if ($host === 'servis.strechybohemia.cz' || $host === 'web.strechybohemia.cz') {
            $this->redirect($primaryHost . $uri);
        }
    
        $this->redirectToWww('strechybohemia.cz');
        
        $this->template->navbar = NavbarHelper::activate($this->navbarDataset->get(), $this->request);
        $this->template->contacts = $this->contactDataset;
        $this->template->whyUs = $this->whyUsDataset;
    
        $this->template->envs = json_encode(array_merge((array)json_decode($this->template->envs, true), [
            'OLD_API_URL' => $_ENV['OLD_API_URL'],
            'GOOGLE_MAPS_API_KEY' => $_ENV['GOOGLE_MAPS_API_KEY']
        ]));
    }
}
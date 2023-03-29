<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Router;

use ContentioSdk\Router\BaseRouter;
use Strategio\Controller\CareerController;
use Strategio\Controller\ContactController;
use Strategio\Controller\HomeController;
use Strategio\Controller\ArticleController;
use Strategio\Controller\RedirectController;
use Strategio\Controller\ReferenceController;
use Strategio\Controller\ServiceController;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class RouterFactory extends BaseRouter
{
    public function createRoutes(): UrlMatcher
    {
        $routes = parent::createRoutes();
        
        $this->add('redirect_1', '/obchod', [RedirectController::class, 'index']);
        $this->add('redirect_2', '/havarijni', [RedirectController::class, 'index']);
        $this->add('redirect_3', '/pravidelny', [RedirectController::class, 'index']);
        
        $this->add('home', '/', [HomeController::class, 'index']);
        $this->add('contact', '/kontakt', [ContactController::class, 'index']);
        
        $this->add('career', '/kariera', [CareerController::class, 'index']);
        $this->add('career_detail', '/kariera/{slug}', [CareerController::class, 'detail']);
        
        $this->add('service_emergency', '/sluzby/opravy-a-servis-strech-24-7', [ServiceController::class, 'emergency']);
        $this->add('service_revisions', '/sluzby/pravidelne-revize-a-kontroly-strech', [ServiceController::class, 'revisions']);
    
        $this->add('reference_list_home', '/reference', [ReferenceController::class, 'index']);
        $this->add('reference_list', '/reference/strana/{page<\d+>}', [ReferenceController::class, 'index']);
        $this->add('reference_detail', '/reference/{slug}', [ReferenceController::class, 'detail']);
    
        $this->add('article_detail', '/{label}/{slug}', [ArticleController::class, 'index']);
        
        return $routes;
    }
}
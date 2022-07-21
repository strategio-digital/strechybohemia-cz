<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Router;

use ContentioSdk\Router\BaseRouter;
use Strategio\Controller\ContactController;
use Strategio\Controller\HomeController;
use Strategio\Controller\ArticleController;
use Strategio\Controller\ServiceController;
use Symfony\Component\Routing\Matcher\UrlMatcher;

class RouterFactory extends BaseRouter
{
    public function createRoutes(): UrlMatcher
    {
        $routes = parent::createRoutes();
        
        $this->add('home', '/', [HomeController::class, 'index']);
        $this->add('contact', '/kontakt', [ContactController::class, 'index']);
        $this->add('service_emergency', '/opravy-a-servis-strech-24-7', [ServiceController::class, 'emergency']);
        $this->add('service_revisions', '/pravidelne-revize-a-kontroly-strech', [ServiceController::class, 'revisions']);
        $this->add('article_detail', '/{label}/{slug}', [ArticleController::class, 'index']);
        
        return $routes;
    }
}
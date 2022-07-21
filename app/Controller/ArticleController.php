<?php
/**
 * Copyright (c) 2022 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.digital, jz@strategio.digital)
 */
declare(strict_types=1);

namespace Strategio\Controller;

use ContentioSdk\Attribute\Template;
use Strategio\Controller\Base\BaseController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends BaseController
{
    #[Template(path: __DIR__ . '/../../view/controller/article.latte')]
    public function index(string $label, string $slug): void
    {
        $this->addRequest('article', 'POST', "article/show-one", [
            'json' => [
                'slug' => $slug,
                'labels' => [$label],
                'suppressLabels' => true,
                'suppressFiles' => false,
                'suppressParagraphs' => true,
                'suppressParagraphFiles' => true,
                'suppressPrevNext' => true,
                'suppressPrevNextFiles' => true,
                'prevNextByLabel' => null
            ]
        ]);
    
        $responses = $this->dispatchRequests('Article Detail');
        $response = $responses['article'];
        $contents = $response->getBody()->getContents();
    
        if ($response->getStatusCode() !== Response::HTTP_OK) {
            $this->renderError($response, $contents);
        }
    
        $this->template->label = $label;
        $this->template->data = json_decode($contents, true);
    }
}
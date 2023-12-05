<?php
/**
 * Copyright (c) 2023 Strategio Digital s.r.o.
 * @author Jiří Zapletal (https://strategio.dev, jz@strategio.dev)
 */
declare(strict_types=1);

namespace Strategio\Controller;

use ContentioSdk\Attribute\Template;
use Strategio\Controller\Base\BaseController;

class CooperationController extends BaseController
{
    #[Template(path: __DIR__ . '/../../view/controller/support.latte')]
    public function index(): void
    {
    }
}
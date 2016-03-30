<?php

namespace Plehatron\LimoncelloBundle\Tests\Integration\Fixture\ApiBundle\Controller;

use Plehatron\LimoncelloBundle\Controller\JsonApiController;
use Plehatron\LimoncelloBundle\Tests\Integration\Fixture\ApiBundle\Entity\Category;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CategoryController extends JsonApiController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $categories = [
            (new Category())->setId(1)->setName('News')->setSlug('news'),
            (new Category())->setId(2)->setName('World')->setSlug('world'),
        ];
        return $this->getResponse($categories);
    }

    /**
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function showAction(Request $request, $id)
    {
        if ($id == 1) {
            $category = (new Category())->setId(1)->setName('News')->setSlug('news');
            return $this->getResponse($category);
        }
        throw new NotFoundHttpException('Category not found');
    }
}

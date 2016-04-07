<?php

namespace Plehatron\LimoncelloBundle\Controller;

use Neomerx\Limoncello\Contracts\IntegrationInterface;
use Neomerx\Limoncello\Http\AppServiceProviderTrait;
use Neomerx\Limoncello\Http\JsonApiTrait;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

abstract class JsonApiController extends Controller
{
    use JsonApiTrait;
    use AppServiceProviderTrait;

    /**
     * @param IntegrationInterface $integration
     */
    public function callInitJsonApiSupport(IntegrationInterface $integration)
    {
        $this->registerResponses($integration);
        $this->registerCodecMatcher($integration);
        $this->registerExceptionThrower($integration);
        $this->initJsonApiSupport($integration);
    }

    /**
     * @param $data
     * @param int $statusCode
     * @param null $links
     * @param null $meta
     * @return Response
     */
    public function getResponse($data, $statusCode = Response::HTTP_OK, $links = null, $meta = null)
    {
        return $this->getContentResponse($data, $statusCode, $links, $meta);
    }
}

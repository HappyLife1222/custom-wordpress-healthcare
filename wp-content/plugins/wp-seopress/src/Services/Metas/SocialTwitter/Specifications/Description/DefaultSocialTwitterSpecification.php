<?php

namespace SEOPress\Services\Metas\SocialTwitter\Specifications\Description;

use SEOPress\Helpers\Metas\SocialSettings;
use SEOPress\Services\Metas\SocialTwitter\Specifications\Description\AbstractDescriptionSpecification;

class DefaultSocialTwitterSpecification extends AbstractDescriptionSpecification
{
    const NAME_SERVICE = 'DefaultDescriptionSocialTwitterSpecification';

    /**
     * @param array $params [
     *     'context' => array
     *
     * ]
     * @return string
     */
    public function getValue($params) {

        $context = $params['context'];
        $post = $params['post'];

        $value = seopress_get_service('DescriptionMeta')->getValue($params['context']);

        return $this->applyFilter(seopress_get_service('TagsToString')->replace($value, $context));

    }



    /**
     *
     * @param array $params [
     *     'post' => \WP_Post
     *     'title' => string
     *     'context' => array
     *
     * ]
     * @return boolean
     */
    public function isSatisfyBy($params)
    {
       return true;
    }
}



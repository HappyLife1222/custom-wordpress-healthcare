<?php

namespace SEOPress\Services\Metas\Description\Specifications;

class TaxonomySpecification
{

    const NAME_SERVICE = 'TaxonomyDescriptionSpecification';

    /**
     * @param array $params [
     *     'context' => array
     *
     * ]
     * @return string
     */
    public function getValue($params) {
        $context = $params['context'];

        $postType = isset($context['post']) ? $context['post']->post_type : null;
        $term = isset($context['term']) ? $context['term'] : null;

        if($term && get_term_meta($term->term_id, '_seopress_titles_desc', true) && !empty($params['description'])){
            $value = $params['description'];
        }
        else{
            $value   = seopress_get_service('TitleOption')->getTaxonomyCptDescription($postType);
        }

        if(empty($value) || !$value){
            return "";
        }

        return seopress_get_service('TagsToString')->replace($value, $context);
    }



    /**
     *
     * @param array $params [
     *     'post' => \WP_Post
     *     'description' => string
     *     'context' => array
     *
     * ]
     * @return boolean
     */
    public function isSatisfyBy($params)
    {
        $context = $params['context'];

        if (($context['is_tax'] || $context['is_category'] || $context['is_tag']) && !$context['is_search']) {
            if(empty($this->getValue($params))){
                return false;
            }

            return true;

        }

        return false;

    }
}



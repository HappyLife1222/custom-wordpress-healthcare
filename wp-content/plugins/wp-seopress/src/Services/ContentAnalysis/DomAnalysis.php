<?php

namespace SEOPress\Services\ContentAnalysis;

defined('ABSPATH') or exit('Cheatin&#8217; uh?');

class DomAnalysis
{
    public function getMatches($content, $targetKeywords)
    {
        $data = [];
        foreach ($targetKeywords as $kw) {
            if (preg_match_all('#\b(' . $kw . ')\b#iu', $content, $m)) {
                $data[$kw][] = $m[0];
            }
        }

        if (empty($data)) {
            return null;
        }

        return $data;
    }

    public function getPostContentAnalyze($id)
    {
        //Get post content (used for Words counter)
        $content = get_post_field('post_content', $id);

        //Cornerstone compatibility
        if (is_plugin_active('cornerstone/cornerstone.php')) {
            $content = get_post_field('post_content', $id);
        }

        //ThriveBuilder compatibility
        if (is_plugin_active('thrive-visual-editor/thrive-visual-editor.php') && empty($content)) {
            $content = get_post_meta($id, 'tve_updated_post', true);
        }

         //Zion Builder compatibility
         if (is_plugin_active('zionbuilder/zionbuilder.php')) {
            $content = $content . get_post_meta($id, '_zionbuilder_page_elements', true);
        }

        //BeTheme is activated
        $theme = wp_get_theme();
        if ('betheme' == $theme->template || 'Betheme' == $theme->parent_theme) {
            $content = $content . get_post_meta($id, 'mfn-page-items-seo', true);
        }

        $post = get_post($id);

        //Add WC product excerpt
        if ('product' == $post->post_type) {
            $content =  $content . get_the_excerpt($id);
        }

        // Bricks
        if (defined('BRICKS_DB_EDITOR_MODE') && ('bricks' == $theme->template || 'Bricks' == $theme->parent_theme)) {
            $page_sections = get_post_meta($id, BRICKS_DB_PAGE_CONTENT, true);
            $editor_mode   = get_post_meta($id, BRICKS_DB_EDITOR_MODE, true);
            if (is_array($page_sections) && 'wordpress' !== $editor_mode) {
                $content = \Bricks\Frontend::render_data($page_sections);
            }
        }

        $content = apply_filters('seopress_content_analysis_content', $content, $id);

        return $content;
    }

    public function getKeywords($options){
        $targetKeywords = isset($options['target_keywords']) && !empty($options['target_keywords']) ? $options['target_keywords'] : get_post_meta($options['id'], '_seopress_analysis_target_kw', true);

        $targetKeywords = array_filter(explode(',', strtolower($targetKeywords)));

        return apply_filters( 'seopress_content_analysis_target_keywords', $targetKeywords, $options['id'] );
    }

    public function getScore($post){
        $analyzes = seopress_get_service('GetContentAnalysis')->getAnalyzes($post);
        $impact = array_unique(array_values(wp_list_pluck($analyzes, 'impact')));
        return $impact;
    }

    public function getDataAnalyze($data, $options)
    {
        if (!isset($options['id'])) {
            return $data;
        }


        $post = get_post($options['id']);

        $targetKeywords = $this->getKeywords($options);

        //Manage keywords with special characters
        foreach ($targetKeywords as $key => $kw) {
            $targetKeywords[$key] = trim(htmlspecialchars_decode($kw, ENT_QUOTES));
        }

        //Remove duplicates
        $targetKeywords = array_unique($targetKeywords);


        $keysAnalyze = [
            "title",
            "description",
            "h1",
            "h2",
            "h3",
        ];

        foreach ($keysAnalyze as $value) {
            if (!isset($data[$value]) || !isset($data[$value]['value'])) {
                continue;
            }
            $data[$value]['matches'] = [];

            $items = $data[$value]['value'];
            if (is_string($items)) {
                $matches = $this->getMatches($items, $targetKeywords);
                if ($matches !== null) {
                    $keys = array_keys($matches);

                    foreach ($keys as $keyMatch => $valueMatch) {
                        $data[$value]['matches'][]= [
                            "key" => $valueMatch,
                            "count" => count($matches[$valueMatch][0])
                        ];
                    }
                }
            } elseif (is_array($items)) {
                foreach ($items as $key => $item) {
                    $matches = $this->getMatches($item, $targetKeywords);
                    if ($matches !== null) {
                        $keys = array_keys($matches);
                        foreach ($keys as $keyMatch => $valueMatch) {
                            $data[$value]['matches'][]= [
                                "key" => $valueMatch,
                                "count" => count($matches[$valueMatch][0])
                            ];
                        }
                    }
                }
            }
        }

        $postContent = apply_filters('seopress_dom_analysis_get_post_content', $this->getPostContentAnalyze($options['id']));

        if (defined('WP_DEBUG') && WP_DEBUG) {
            $data['analyzed_content'] = $postContent;
            $data['analyzed_content_id'] = $options['id'];
        }

        //Keywords in permalink
        $slug = urldecode($post->post_name);

        if (is_plugin_active('permalink-manager-pro/permalink-manager.php')) {
            global $permalink_manager_uris;
            if (!empty($permalink_manager_uris) && !empty($options) && is_array($options) && array_key_exists('id', $options)) {
                $slug = isset($permalink_manager_uris[$options['id']]) ? $permalink_manager_uris[$options['id']] : '';
                $slug = urldecode($slug);
            }
        }

        $slug = str_replace('-', ' ', $slug);

        $data['kws_permalink'] = [
            "matches" => []
        ];

        if (!empty($targetKeywords)) {
            $matches = $this->getMatches($slug, $targetKeywords);
            if ($matches !== null) {
                $keys = array_keys($matches);
                foreach ($keys as $key => $value) {
                    $data['kws_permalink']['matches'][]= [
                        "key" => $value,
                        "count" => count($matches[$value][0])
                    ];
                }
            }
        }

        //Old post
        $data['old_post'] = [
            'value' => strtotime($post->post_modified) < strtotime('-365 days')
        ];

        return $data;
    }
}

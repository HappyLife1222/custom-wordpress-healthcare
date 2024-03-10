<?php

namespace SEOPress\Actions\Sitemap;

defined('ABSPATH') or exit('Cheatin&#8217; uh?');

use SEOPress\Core\Hooks\ExecuteHooks;

class Router implements ExecuteHooks {
    /**
     * @since 4.3.0
     *
     * @return void
     */
    public function hooks() {
        add_action('init', [$this, 'init']);
        add_filter('query_vars', [$this, 'queryVars']);
    }

    /**
     * @since 4.3.0
     * @see init
     *
     * @return void
     */
    public function init() {
        if ('1' !== seopress_get_service('SitemapOption')->isEnabled() || '1' !== seopress_get_toggle_option('xml-sitemap')) {
            return;
        }

        //XML Index
        add_rewrite_rule('^sitemaps.xml$', 'index.php?seopress_sitemap=1', 'top');

        //XSL Sitemap
        add_rewrite_rule('^sitemaps_xsl.xsl$', 'index.php?seopress_sitemap_xsl=1', 'top');

        //XSL Video Sitemap
        add_rewrite_rule('^sitemaps_video_xsl.xsl$', 'index.php?seopress_sitemap_video_xsl=1', 'top');

        add_rewrite_rule('([^/]+?)-sitemap([0-9]+)?\.xml$', 'index.php?seopress_cpt=$matches[1]&seopress_paged=$matches[2]', 'top');

        //XML Author
        if ('1' === seopress_get_service('SitemapOption')->authorIsEnable()) {
            add_rewrite_rule('author.xml?$', 'index.php?seopress_author=1', 'top');
        }
    }

    /**
     * @since 4.3.0
     * @see query_vars
     *
     * @param array $vars
     *
     * @return array
     */
    public function queryVars($vars) {
        $vars[] = 'seopress_sitemap';
        $vars[] = 'seopress_sitemap_xsl';
        $vars[] = 'seopress_sitemap_video_xsl';
        $vars[] = 'seopress_cpt';
        $vars[] = 'seopress_paged';
        $vars[] = 'seopress_author';

        return $vars;
    }
}

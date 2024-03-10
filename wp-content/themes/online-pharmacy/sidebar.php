<?php
/**
 * The sidebar containing the main widget area
 * @package Online Pharmacy
 * @subpackage online_pharmacy
 */
?>

<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Blog Sidebar', 'online-pharmacy' ); ?>">
    <?php if (!dynamic_sidebar('sidebar-1')) : ?>
        <section id="search" class="widget widget_search">
            <h3 class="widget-title"><?php esc_html_e('Search', 'online-pharmacy'); ?></h3>
            <?php get_search_form(); ?>
        </section>

        <section id="meta" class="widget widget_meta">
            <h3 class="widget-title"><?php esc_html_e('Meta', 'online-pharmacy'); ?></h3>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </section>

        <section id="archives" class="widget widget_archive">
            <h3 class="widget-title"><?php esc_html_e('Archives', 'online-pharmacy'); ?></h3>
            <ul>
                <?php wp_get_archives(); ?>
            </ul>
        </section>

        <section id="tag-cloud" class="widget widget_tag_cloud">
            <h3 class="widget-title"><?php esc_html_e('Tag Cloud', 'online-pharmacy'); ?></h3>
            <?php wp_tag_cloud(); ?>
        </section>
    <?php endif; ?>
</aside>

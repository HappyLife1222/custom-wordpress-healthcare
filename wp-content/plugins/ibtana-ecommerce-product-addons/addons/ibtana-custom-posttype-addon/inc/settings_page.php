<?php Ibtana_Visual_Editor_Menu_Class::ibtana_visual_editor_banner_head(); ?>

<div class="icpa-content">


    <ul class="nav nav-tabs">
      <li class="active posttype_tab">
        <a data-toggle="tab" href="#posttype">
          <?php esc_html_e( 'Posttype', 'ibtana-ecommerce-product-addons' ) ?>
        </a>
      </li>
      <li class="taxonomy_tab">
        <a data-toggle="tab" href="#taxonomy">
          <?php esc_html_e( 'Taxonomy', 'ibtana-ecommerce-product-addons' ) ?>
        </a>
      </li>
    </ul>
    <div class="tab-content">
      <div id="posttype" class="tab-pane fade in active">
        <?php include_once( 'tabs/basic-settings.php' ); ?>
        <?php include_once( 'tabs/posttype-table.php' ); ?>
      </div>
      <div id="taxonomy" class="tab-pane fade">
        <?php include_once( 'tabs/taxonomy-settings.php' ); ?>
        <?php include_once( 'tabs/taxonomy-table.php' ); ?>
      </div>
    </div>
</div>

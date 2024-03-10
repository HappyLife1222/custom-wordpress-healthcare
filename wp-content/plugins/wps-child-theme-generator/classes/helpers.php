<?php

namespace WPS\WPS_Child_Theme_Generator;

class Helpers {

	use Singleton;

	/**
	 * @return string
	 */
	public static function available_parent_themes() {

		$themes = wp_get_themes();

		$options = '';
		foreach ( $themes as $theme => $theme_data ) {
			$this_theme = wp_get_theme( $theme_data->get_template() );
			if ( $theme === $theme_data->get_template() ) {
				$options .= '<option value="' . $theme . '">' . $this_theme->get( 'Name' ) . '</option>';
			}
		}

		return $options;
	}

	/**
	 * @return string
	 */
	public static function create_child_theme() {

		if (
			! isset( $_POST['form_field_nonce'] )
			|| ! wp_verify_nonce( $_POST['form_field_nonce'], 'form_generator' )
		) {
		    return false;
        }

		$b7ectg_show       = esc_attr( $_POST ['b7ectg_parenttheme'] );
		$b7ectg_title      = $_POST['b7ectg_childtheme'] != '' ? esc_attr( $_POST['b7ectg_childtheme'] ) : $b7ectg_show . ' Child';
		$b7ectg_url        = $_POST['b7ectg_themeurl'] != '' ? esc_url( $_POST['b7ectg_themeurl'] ) : 'https://www.wpserveur.net';
		$b7ectg_author     = $_POST['b7ectg_author'] != '' ? esc_attr( $_POST['b7ectg_author'] ) : 'WPServeur';
		$b7ectg_author_url = $_POST['b7ectg_authurl'] != '' ? esc_url( $_POST['b7ectg_authurl'] ) : 'https://www.wpserveur.net';
		$new_themename     = $_POST['b7ectg_childtheme'] ? str_replace( ' ', '-', strtolower( $b7ectg_title ) ) . '-' . strtolower( $b7ectg_show ) . '-child' : strtolower( $b7ectg_show ) . '-child';

		$dir = get_theme_root();

		$dir_name = $dir . "/" . $new_themename;
		if ( file_exists( $dir_name ) ) {
			return '<div id="message" class="error fade"><p>Child Theme ' . $new_themename . ' Already Exists.</p></div>';
		} else {
			wp_mkdir_p( $dir_name );
			$css_content = '/*' . PHP_EOL;
			$css_content .= 'Theme Name: ' . $b7ectg_title . PHP_EOL;
			$css_content .= 'Theme URI:  ' . $b7ectg_url . PHP_EOL;
			$css_content .= 'Author:     ' . $b7ectg_author . PHP_EOL;
			$css_content .= 'Author URI: ' . $b7ectg_author_url . PHP_EOL;
			$css_content .= 'Template:   ' . $b7ectg_show . PHP_EOL;
			$css_content .= 'Version:    1.0' . PHP_EOL;
			$css_content .= 'License:    GNU General Public License v2 or later' . PHP_EOL;
			$css_content .= '*/';


			if ( isset( $_POST['b7ectg_add_css'] ) && $_POST['b7ectg_add_css'] != '' ) {

				$css_content .= "
			    
/* CSS added with WPS Child Theme Generator */			    

";
				$css_content .= $_POST["b7ectg_add_css"];

			}

			$php_content = "<?php 
/* Child theme generated with WPS Child Theme Generator */
            
if ( ! function_exists( 'b7ectg_theme_enqueue_styles' ) ) {            
    add_action( 'wp_enqueue_scripts', 'b7ectg_theme_enqueue_styles' );
    
    function b7ectg_theme_enqueue_styles() {
        wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
        wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
    }
}
";

			if ( isset( $_POST['b7ectg_img_id'] ) ) {
				$thumbnail_path = get_attached_file( $_POST['b7ectg_img_id'] );
				if ( file_exists( $thumbnail_path ) ) {
					$ext = pathinfo( $thumbnail_path, PATHINFO_EXTENSION );
					copy( $thumbnail_path, $dir_name . '/screenshot.' . $ext );
				}
			}

			if ( isset( $_POST['b7ectg_options'] ) ) {
				$perform_options = self::perform_options();

				if ( $perform_options !== null || sizeof( $perform_options ) == 0 ) {
					foreach ( $perform_options as $key => $_php_content ) {
						$php_content .= $_php_content;
					}
				}
			}

			$files_create = self::_create_child_theme( $css_content, $php_content, $dir_name );

			if ( $files_create !== true ) {
				return '<div class="notice notice-error"><p>' . __( 'Failed to create files', 'wps-child-theme-generator' ) . '</p></div>';
			}
			if ( extension_loaded( 'zip' ) === true ) {
				$zip = self::_create_zip( $dir_name, $new_themename );
			}
			if ( isset( $_POST['be7ctg_send'] ) && isset( $_POST['be7ctg_send_email'] ) && $_POST['be7ctg_send_email'] != '' ) {
				if ( $zip === true ) {

					$subject = __( 'Your child theme', 'wps-child-theme-generator' );

					ob_start();
					?>
                    Hello,

                    You can find enclose your child thème created with WPS Child Theme Generator.

                    Name : <?php echo $b7ectg_title; ?>

                    Template : <?php echo $b7ectg_show; ?>

                    All the best :)
					<?php

					$message     = ob_get_clean();
					$attachments = array( get_theme_root( $new_themename ) . '.zip' );
					wp_mail( esc_attr( $_POST['be7ctg_send_email'] ), $subject, $message, '', $attachments );
				}
			}

			$zip_link = self::abs_path_to_url( get_theme_root( $new_themename ) . '.zip' );

			return '<div class="notice notice-success"><p>' . __( 'Child theme created', 'wps-child-theme-generator' ) . '</p>
                        <p><a href="' . esc_url( $zip_link ) . '">' . __( 'Download child theme', 'wps-child-theme-generator' ) . '</a></p></div>';
		}
	}

	/**
	 * @param string $path
	 *
	 * @return string
	 */
	public static function abs_path_to_url( $path = '' ) {
		$url = str_replace(
			wp_normalize_path( untrailingslashit( ABSPATH ) ),
			site_url(),
			wp_normalize_path( $path )
		);

		return esc_url_raw( $url );
	}

	/**
	 * @param $css_content
	 * @param $php_content
	 * @param $dir_name
	 *
	 * @return bool
	 */
	public static function _create_child_theme( $css_content, $php_content, $dir_name ) {

		global $wp_filesystem;

		if ( empty( $wp_filesystem ) ) {
			require_once( ABSPATH . '/wp-admin/includes/file.php' );
			WP_Filesystem();
		}

		if ( ! $wp_filesystem->put_contents( $dir_name . '/style.css', $css_content, 0644 ) ) {
			return false;
		}
		if ( ! $wp_filesystem->put_contents( $dir_name . '/functions.php', $php_content, 0644 ) ) {
			return false;
		}

		return true;
	}

	/**
	 * @param $source
	 * @param $file_name
	 *
	 * @return bool
	 */
	public static function _create_zip( $source, $file_name ) {

		// Get real path for our folder
		$rootPath = $source;

		// Initialize archive object
		$zip = new \ZipArchive();
		$zip->open( get_theme_root( $file_name )  . '.zip', \ZipArchive::CREATE | \ZipArchive::OVERWRITE );

		// Create recursive directory iterator
		/** @var SplFileInfo[] $files */
		$files = new \RecursiveIteratorIterator(
			new \RecursiveDirectoryIterator( $rootPath )
		);

		foreach ( $files as $name => $file ) {
			// Skip directories (they would be added automatically)
			if ( ! $file->isDir() ) {
				// Get real and relative path for current file
				$filePath     = $file->getRealPath();
				$relativePath = substr( $filePath, strlen( $rootPath ) + 1 );

				// Add current file to archive
				$zip->addFile( $filePath, $relativePath );
			}
		}

		// Zip archive will be created only after closing object
		$zip->close();

		return true;
	}

	/**
	 * @return array
	 */
	public static function _get_image_sizes() {
		global $_wp_additional_image_sizes;

		$sizes = array();

		foreach ( get_intermediate_image_sizes() as $_size ) {
			if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
				$sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
				$sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
				$sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
			} elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
				$sizes[ $_size ] = array(
					'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
					'height' => $_wp_additional_image_sizes[ $_size ]['height'],
					'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
				);
			}
		}

		return $sizes;
	}

	/**
	 *
	 */
	public static function image_sizes_render() {
		foreach ( self::_get_image_sizes() as $name => $size ) {
			echo '<label class="wps-cb-separator"><input type="checkbox" value="' . esc_attr( $name ) . '" name="b7ectg_image_sizes[]" checked="checked"/>' . $name . ' ' . $size['width'] . 'x' . $size['height'] . '</label></br>';
		}
	}

	/**
	 * @return array
	 */
	public static function _get_post_types() {
		$args = apply_filters( 'b7ectg_search_cpt', array(
			'public'            => true,
			'show_in_nav_menus' => true
		) );

		$post_types = get_post_types( $args, 'objects', 'and' );

		return $post_types;
	}

	/**
	 * @return string
	 */
	public static function get_post_type_render() {
		$results = '';
		foreach ( self::_get_post_types() as $post_type ) {
			$results .= '<label class="wps-cb-separator"><input type="checkbox" name="b7ectg_search_cpt[]" value="' . esc_attr( $post_type->name ) . '"/>' . $post_type->label . '</label>';
		}

		return $results;
	}

	/**
	 * @return array
	 */
	public static function _registered_widgets() {
		global $wp_widget_factory;

		$widgets       = array_keys( $wp_widget_factory->widgets );
		$widgets_datas = array_values( $wp_widget_factory->widgets );

		// Array_column Compat PHP 5.6 / 7
		$widgets_datas = array_map( function ( $e ) {
			return is_object( $e ) ? $e->name : $e['name'];
		}, $widgets_datas );
		$widgets_array = array_combine( $widgets, $widgets_datas );

		return $widgets_array;
	}

	/**
	 * @param $data
	 *
	 * @return null|string|string[]
	 */
	public static function _sanitize_value( $data ) {
		$sanitization = preg_replace( "/[^\d]/", "", $data );

		return $sanitization;
	}

	/**
	 *
	 */
	public static function registered_widgets_render() {
		foreach ( self::_registered_widgets() as $widget_class_name => $widget_name ) { ?>
            <label class="wps-cb-separator"> <input type="checkbox" name="b7ectg_widget[]" value="<?php echo $widget_class_name; ?>"
                   checked="checked"> <?php echo $widget_name; ?></label>
			<?php
		}
	}

	/**
	 * @return array
	 */
	public static function perform_options() {

		if ( isset( $_POST['b7ectg_options'] ) ) {
			$unwanted_image_size = array_diff( array_keys( self::_get_image_sizes() ), array_values( $_POST['b7ectg_image_sizes'] ) );
			$unwanted_widgets    = array_diff( array_keys( self::_registered_widgets() ), array_values( $_POST['b7ectg_widget'] ) );
		}

		/* Remove Image sizes */
		$image_size_code = '';

		if ( is_array( $unwanted_image_size ) && $unwanted_image_size != null ) {
			$image_size_code .= "
/* Remove image size */
if ( ! function_exists( 'b7ectg_remove_image_size' ) ) { 
    add_action('init','b7ectg_remove_image_size');
    
    function b7ectg_remove_image_size() {";

			foreach ( $unwanted_image_size as $k => $name ) {
				$image_size_code .= "
        remove_image_size( '$name' );";
			}
			$image_size_code .= "
    }
}";
		}
		/* Add image sizes */

		if ( isset( $_POST['b7ectg_new_img_size'] ) ) {
			foreach ( $_POST['b7ectg_new_img_size'] as $new_size ) {

				$width           = ( $new_size['width'] === 0 ) ? '100' : self::_sanitize_value( $new_size['width'] );
				$height          = ( $new_size['height'] === 0 ) ? '9999' : self::_sanitize_value( $new_size['height'] );
				$crop            = ( ! isset( $new_size['crop'] ) ) ? 'false' : 'true';
				$image_size_code .= '
/* Image sizes */                
if ( function_exists( "add_image_size" ) ) {                
    add_image_size( "' . $new_size['slug'] . '", ' . $width . ', ' . $height . ', ' . $crop . ' );';
			}
			$add_sizes = '';
			foreach ( $_POST['b7ectg_new_img_size'] as $add_size ) {
				$add_sizes .= '
                "' . $add_size['slug'] . '" => "' . $add_size['name'] . '"';
			}

			$image_size_code .= '
}';
			$image_size_code .= '
if ( ! function_exists( "b7ectg_add_size_to_media_library" ) ) {
    add_action("image_size_names_choose", ""); 
    
    function b7ectg_add_size_to_media_library($sizes){
        $add_sizes = array(
                    ' . $add_sizes . '
                    );
            $new_sizes = array_merge($sizes, $add_sizes);
            return $new_sizes;
    }
}
';
		}

		$widget_code = '';
		if ( is_array( $unwanted_widgets ) && $unwanted_widgets != null ) {
			$widget_code .= "
/* Unregistered Widgets */
if ( ! function_exists( 'b7ectg_unregister_widget' ) ) {
    add_action( 'widgets_init', 'b7ectg_unregister_widget' );
    
    function b7ectg_unregister_widget() {
    ";

			foreach ( $unwanted_widgets as $k => $widget ) {
				$widget_code .= "
        unregister_widget( '$widget' );";
			}
			$widget_code .= "
    }
}";
		}

		if ( isset( $_POST['b7ectg_widget_shortcode'] ) ) {
			$widget_code .= '
if ( ! is_admin() ) {
    add_filter("widget_text", "do_shortcode", 11);
}            
';
		}

		$search_slug = '';
		if ( isset( $_POST['b7ectg_search_slug'] ) ) {
			$search_slug .= '
/* Search slug */
if ( ! function_exists( "b7ectg_rewrite_search_slug" ) ) {
    add_action( "template_redirect", "b7ectg_rewrite_search_slug" );
    
    function b7ectg_rewrite_search_slug() {
        if ( is_search() && ! empty( $_GET["s"] ) ) {
            wp_redirect( home_url( "/' . __( 'search' ) . '/" ) . urlencode( get_query_var( "s" ) ) );
            exit();
        }
    }
}';
			$search_slug .= '
if ( ! function_exists( "b7ectg_rewrite_search_slug_pagination" ) ) {
    add_action( "init", "b7ectg_rewrite_search_slug_pagination" );
    
    function b7ectg_rewrite_search_slug_pagination() {  
    
        if ( is_search() ) {
            add_rewrite_rule(
                "' . __( 'search' ) . '(/([^/]+))?(/([^/]+))?(/([^/]+))?/?",
                "index.php?s=$matches[2]&paged=$matches[6]",
                 "top"      
            );
        }  
    }
}
            ';
		}

		$search_cpt = '';

		if ( isset ( $_POST['b7ectg_search_cpt'] ) ) {

			$list       = "'" . implode( "','", $_POST['b7ectg_search_cpt'] ) . "'";
			$search_cpt .= '
/* Search custom post type */  
if ( ! function_exists( "be7ctg_search_cpt" ) ) {
    function be7ctg_search_cpt( $query ) {            
        if ( $query->is_search ) { 
            $query->set( "post_type", array( ' . $list . ' ) );
            return $query;
        }
    }    
    add_filter( "the_search_query", "be7ctg_search_cpt" );
}         
';
		}

		/*$svg_support = '';
		if ( isset ( $_POST['b7ectg_svg'] ) ) {
			$svg_support .= '
if ( ! function_exists( "b7ectg_mime_types" ) ) {
    function b7ectg_mime_types( $mimes ){
        $mimes["svg"] = "image/svg+xml";
        return $mimes;
    }
    add_filter( "upload_mimes", "b7ectg_mime_types" );
}
            ';
		}*/

		$thumb_col = '';

		if ( isset( $_POST['b7ectg_admin_post_thumb_col'] ) ) {
			$thumb_col .= "
/* Thumbnail column */            
if ( function_exists( 'add_theme_support' ) ) {";
			if ( $_POST['b7ectg_admin_post_thumb_col_post'] ) {
				$thumb_col .= "
    add_filter( 'manage_posts_columns', 'b7ectg_posts_thumb_columns', 5 );
    add_filter( 'manage_posts_columns', 'b7ectg_post_thumb_order', 5 );
    add_action( 'manage_posts_custom_column', 'b7ectg_posts_custom_thumb_columns', 5, 2 );";
			}

			if ( $_POST['b7ectg_admin_post_thumb_col_page'] ) {
				$thumb_col .= "
    add_filter( 'manage_pages_columns', 'b7ectg_posts_thumb_columns', 5 );
    add_filter( 'manage_pages_columns', 'b7ectg_post_thumb_order', 5 );
    add_action( 'manage_pages_custom_column', 'b7ectg_posts_custom_thumb_columns', 5, 2 );";
			}

			$thumb_col .= "
}";

			$thumb_col .= '
function b7ectg_posts_thumb_columns( $defaults ) {
    $defaults["b7ectg_post_thumbs"] = __( "Thumbs" );
    return $defaults;
}
function b7ectg_post_thumb_order( $columns ) {
    $n_columns = array();
    $before = "title"; // move before this
    foreach ( $columns as $key => $value ) {
        if ( $key == $before ) {
          $n_columns["b7ectg_post_thumbs"] = "";
        }
        $n_columns[$key] = $value;
    }
    
    return $n_columns;
}
function b7ectg_posts_custom_thumb_columns( $column_name, $id ) {
        if ( $column_name === "b7ectg_post_thumbs" ) {
        echo the_post_thumbnail( array( 100, 100 ) );
    }
}            ';

		}

		if ( isset( $_POST['b7ectg_admin_post_id_col'] ) ) {
			if ( isset( $_POST['b7ectg_admin_post_thumb_col'] ) ) {
				$the_col_before = 'b7ectg_post_thumbs';
			} else {
				$the_col_before = 'title';
			}


			$thumb_col .= "
/* ID column */            
if ( function_exists( 'add_theme_support' ) ) {";

			if ( $_POST['b7ectg_admin_post_id_col_post'] ) {
				$thumb_col .= "
    add_filter( 'manage_posts_columns', 'b7ectg_posts_id_columns', 5 );
    add_filter( 'manage_posts_columns', 'b7ectg_post_id_order', 5 );
    add_action( 'manage_posts_custom_column', 'b7ectg_posts_custom_id_columns', 5, 2 );";
			}
			if ( $_POST['b7ectg_admin_post_id_col_page'] ) {
				$thumb_col .= "
    add_filter( 'manage_pages_columns', 'b7ectg_posts_id_columns', 5 );
    add_filter( 'manage_pages_columns', 'b7ectg_post_id_order', 5 );
    add_action( 'manage_pages_custom_column', 'b7ectg_posts_custom_id_columns', 5, 2 );";
			}

			$thumb_col .= "
}";
			$thumb_col .= '
function b7ectg_posts_id_columns( $defaults ) {
    $defaults["b7ectg_post_ID"] = __( "ID" );
    return $defaults;
}
function b7ectg_post_id_order( $columns ) {
    $n_columns = array();
    $before = "' . $the_col_before . '"; // move before this
    foreach( $columns as $key => $value ) {
      if ( $key == $before ) {
       $n_columns["b7ectg_post_ID"] = "";
      }
      $n_columns[$key] = $value;
  }
  
  return $n_columns;
}
function b7ectg_posts_custom_id_columns( $column_name, $id ) {
        if ( $column_name === "b7ectg_post_ID" ) {
        echo $id;
    }
}            ';
		}

		$supports_remove = '';

		if ( isset( $_POST['b7ectg_options'] ) ) {
			if ( isset( $_POST['b7ectg_supports_block'] ) ) {

				global $_wp_post_type_features;

				$supports_by_type = array_values( array_values( array_values( $_wp_post_type_features ) ) );
				foreach ( $supports_by_type as $item => $support ) {
					$array_support_by_type[] = array_keys( $support );
				}
				$suport_by_type_posted = array_values( $_POST['b7ectg_support'] );
				foreach ( $suport_by_type_posted as $item => $support ) {
					$array_support_by_type_posted[] = array_keys( $support );
				}
				$cpt_types = array_keys( $_wp_post_type_features );
				$i         = 0;
				foreach ( $cpt_types as $item ) {
					$unwanted_support[ $item ] = array_diff( $array_support_by_type[ $i ], $array_support_by_type_posted[ $i ] );
					$i ++;
				}

				$supports_remove .= "
/* Remove supports */
if ( ! function_exists( 'b7ectg_remove_supports' ) ) {
    add_action( 'init', 'b7ectg_remove_supports' );
    
    function b7ectg_remove_supports() {                
                    ";
				foreach ( $unwanted_support as $cpt_type => $remove_supports ) {
					if ( sizeof( $remove_supports ) != 0 ) {
						foreach ( $remove_supports as $k => $support ) {
							$supports_remove .= "
        remove_post_type_support( '$cpt_type', '$support' );";
						}
					}
				}
				$supports_remove .= "
    }
}          
                ";
			}
		}

		return array(
			'image_sizes'         => $image_size_code,
			'thumb_post_col'      => $thumb_col,
			'widget'              => $widget_code,
			'rewrite_search_slug' => $search_slug,
			'search_cpt'          => $search_cpt,
			//'svg_support' => $svg_support,
			'remove_support'      => $supports_remove
		);
	}
}
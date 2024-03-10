<?php
defined( 'ABSPATH' ) or die( 'No script kiddies please!!' );
if ( !class_exists( 'IEPA_MM_Activation' ) ) {
  class IEPA_MM_Activation extends IEPA_MM_Libary {
    /**
    * Executes all the tasks on Plugin activation
    *
    * @since 1.0.0
    */
    function __construct() {
      add_action( 'init', array( $this, 'iepa_mm_initialize' ) );
      // register_activation_hook( IEPA_PLUGIN_FILE, array( $this, 'iepa_mm_activation' ) );
    }

    /*
    * Loads the text domain for translation and Session Start, Header start Check
    */
    function iepa_mm_initialize() {
      load_plugin_textdomain( IEPA_TEXT_DOMAIN, false, basename( dirname( __FILE__ ) ) . '/languages' ); //Loads plugin text domain for the translation
      $this->iepa_mm_activation();
    }

    /*
    * Plugin Activation Default Setup
    */
    function iepa_mm_activation() {
      include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
      if ( is_multisite() ) {
        include( IEPA_MM_PATH . 'inc/backend/multisite-activation.php' );
      } else {
        include( IEPA_MM_PATH . 'inc/backend/activation.php' );
      }

      /**
      * Load Default Settings
      * */
      if ( !get_option( 'iepamega_settings' ) ) {
        $iepamega_settings = $this->iepa_mm_default_settings();
        update_option( 'iepamega_settings', $iepamega_settings );
      }

      /**
       * Google font save
       * */
      $family = array('ABeeZee','Abel','Abril Fatface','Aclonica','Acme','Actor','Adamina','Advent','Aguafina Script','Akronim','Aladin','Aldrich','Alef','Alegreya','Alegreya SC','Alegreya Sans','Alegreya Sans SC','Alex Brush','Alfa Slab One','Alice','Alike','Alike Angular','Allan','Allerta','Allerta Stencil','Allura','Almendra','Almendra Display','Almendra SC','Amarante','Amaranth','Amatic SC','Amethysta','Amiri','Amita','Anaheim','Andada','Andika','Angkor','Annie Use Your Telescope','Anonymous','Antic','Antic Didone','Antic Slab','Anton','Arapey','Arbutus','Arbutus Slab','Architects Daughter','Archivo Black','Archivo Narrow','Arimo','Arizonia','Armata','Artifika','Arvo','Arya','Asap','Asar','Asset','Astloch','Asul','Atomic Age','Aubrey','Audiowide','Autour One','Average','Average Sans','Averia Gruesa Libre','Averia Libre','Averia Sans Libre','Averia Serif Libre','Bad Script','Balthazar','Bangers','Basic','Battambang','Baumans','Bayon','Belgrano','Belleza','BenchNine','Bentham','Berkshire Swash','Bevan','Bigelow Rules','Bigshot One','Bilbo','Bilbo Swash Caps','Biryani','Bitter','Black Ops One','Bokor','Bonbon','Boogaloo','Bowlby One','Bowlby One SC','Brawler','Bree Serif','Bubblegum Sans','Bubbler One','Buda','Buenard','Butcherman','Butterfly Kids','Cabin','Cabin Condensed','Cabin Sketch','Caesar Dressing','Cagliostro','Calligraffitti','Cambay','Cambo','Candal','Cantarell','Cantata One','Cantora One','Capriola','Cardo','Carme','Carrois Gothic','Carrois Gothic SC','Carter One','Caudex','Cedarville Cursive','Ceviche One','Changa One','Chango','Chau Philomene One','Chela One','Chelsea Market','Chenla','Cherry Cream Soda','Cherry Swash','Chewy','Chicle','Chivo','Cinzel','Cinzel Decorative','Clicker Script','Coda','Coda Caption','Codystar','Combo','Comfortaa','Coming Soon','Concert One','Condiment','Content','Contrail One','Convergence','Cookie','Copse','Corben','Courgette','Cousine','Coustard','Covered By Your Grace','Crafty Girls','Creepster','Crete Round','Crimson Text','Croissant One','Crushed','Cuprum','Cutive','Cutive Mono','Damion','Dancing Script','Dangrek','Dawning of a New Day','Days One','Dekko','Delius','Delius Swash Caps','Delius Unicase','Della Respira','Denk One','Devonshire','Dhurjati','Didact Gothic','Diplomata','Diplomata SC','Domine','Donegal One','Doppio One','Dorsa','Dosis','Dr Sugiyama','Droid Sans','Droid Sans Mono','Droid Serif','Duru Sans','Dynalight','EB Garamond','Eagle Lake','Eater','Economica','Eczar','Ek Mukta','Electrolize','Elsie','Elsie Swash Caps','Emblema One','Emilys Candy','Engagement','Englebert','Enriqueta','Erica One','Esteban','Euphoria Script','Ewert','Exo','Exo 2','Expletus Sans','Fanwood Text','Fascinate','Fascinate Inline','Faster One','Fasthand','Fauna One','Federant','Federo','Felipa','Fenix','Finger Paint','Fira Mono','Fira Sans','Fjalla One','Fjord One','Flamenco','Flavors','Fondamento','Fontdiner Swanky','Forum','Francois One','Freckle Face','Fredericka the Great','Fredoka One','Freehand','Fresca','Frijole','Fruktur','Fugaz One','GFS Didot','GFS Neohellenic','Gabriela','Gafata','Galdeano','Galindo','Gentium Basic','Gentium Book Basic','Geo','Geostar','Geostar Fill','Germania One','Gidugu','Gilda Display','Give You Glory','Glass Antiqua','Glegoo','Gloria Hallelujah','Goblin One','Gochi Hand','Gorditas','Goudy Bookletter 1911','Graduate','Grand Hotel','Gravitas One','Great Vibes','Griffy','Gruppo','Gudea','Gurajada','Habibi','Halant','Hammersmith One','Hanalei','Hanalei Fill','Handlee','Hanuman','Happy Monkey','Headland One','Henny Penny','Herr Von Muellerhoff','Hind','Holtwood One SC','Homemade Apple','Homenaje','IM Fell DW Pica','IM Fell DW Pica SC','IM Fell Double Pica','IM Fell Double Pica SC','IM Fell English','IM Fell English SC','IM Fell French Canon','IM Fell French Canon SC','IM Fell Great Primer','IM Fell Great Primer SC','Iceberg','Iceland','Imprima','Inconsolata','Inder','Indie Flower','Inika','Inknut Antiqua','Irish Grover','Istok Web','Italiana','Italianno','Jacques Francois','Jacques Francois Shadow','Jaldi','Jim Nightshade','Jockey One','Jolly Lodger','Josefin Sans','Josefin Slab','Joti One','Judson','Julee','Julius Sans One','Junge','Jura','Just Another Hand','Just Me Again Down Here','Kadwa','Kalam','Kameron','Kantumruy','Karla','Karma','Kaushan Script','Kavoon','Kdam Thmor','Keania One','Kelly Slab','Kenia','Khand','Khmer','Khula','Kite One','Knewave','Kotta One','Koulen','Kranky','Kreon','Kristi','Krona One','Kurale','La Belle Aurore','Laila','Lakki Reddy','Lancelot','Lateef','Lato','League Script','Leckerli One','Ledger','Lekton','Lemon','Libre Baskerville','Life Savers','Lilita One','Lily Script One','Limelight','Linden Hill','Lobster','Lobster Two','Londrina Outline','Londrina Shadow','Londrina Sketch','Londrina Solid','Lora','Love Ya Like A Sister','Loved by the King','Lovers Quarrel','Luckiest Guy','Lusitana','Lustria','Macondo','Macondo Swash Caps','Magra','Maiden Orange','Mako','Mallanna','Mandali','Marcellus','Marcellus SC','Marck Script','Margarine','Marko One','Marmelad','Martel','Martel Sans','Marvel','Mate','Mate SC','Maven','McLaren','Meddon','MedievalSharp','Medula One','Megrim','Meie Script','Merienda','Merienda One','Merriweather','Merriweather Sans','Metal','Metal Mania','Metamorphous','Metrophobic','Michroma','Milonga','Miltonian','Miltonian Tattoo','Miniver','Miss Fajardose','Modak','Modern Antiqua','Molengo','Molle','Monda','Monofett','Monoton','Monsieur La Doulaise','Montaga','Montez','Montserrat','Montserrat Alternates','Montserrat Subrayada','Moul','Moulpali','Mountains of Christmas','Mouse Memoirs','Mr Bedfort','Mr Dafoe','Mr De Haviland','Mrs Saint Delafield','Mrs Sheppards','Muli','Mystery Quest','NTR','Neucha','Neuton','New Rocker','News Cycle','Niconne','Nixie One','Nobile','Nokora','Norican','Nosifer','Nothing You Could Do','Noticia Text','Noto Sans','Noto Serif','Nova Cut','Nova Flat','Nova Mono','Nova Oval','Nova Round','Nova Script','Nova Slim','Nova Square','Numans','Nunito','Odor Mean Chey','Offside','Old Standard TT','Oldenburg','Oleo Script','Oleo Script Swash Caps','Open Sans','Open Sans Condensed','Oranienbaum','Orbitron','Oregano','Orienta','Original Surfer','Oswald','Over the Rainbow','Overlock','Overlock SC','Ovo','Oxygen','Oxygen Mono','PT Mono','PT Sans','PT Sans Caption','PT Sans Narrow','PT Serif','PT Serif Caption','Pacifico','Palanquin','Palanquin Dark','Paprika','Parisienne','Passero One','Passion One','Pathway Gothic One','Patrick Hand','Patrick Hand SC','Patua One','Paytone One','Peddana','Peralta','Permanent Marker','Petit Formal Script','Petrona','Philosopher','Piedra','Pinyon Script','Pirata One','Plaster','Play','Playball','Playfair Display','Playfair Display SC','Podkova','Poiret One','Poller One','Poly','Pompiere','Pontano Sans','Poppins','Port Lligat Sans','Port Lligat Slab','Pragati Narrow','Prata','Preahvihear','Press Start 2P','Princess Sofia','Prociono','Prosto One','Puritan','Purple Purse','Quando','Quantico','Quattrocento','Quattrocento Sans','Questrial','Quicksand','Quintessential','Qwigley','Racing Sans One','Radley','Rajdhani','Raleway','Raleway Dots','Ramabhadra','Ramaraja','Rambla','Rammetto One','Ranchers','Rancho','Ranga','Rationale','Ravi Prakash','Redressed','Reenie Beanie','Revalia','Rhodium Libre','Ribeye','Ribeye Marrow','Righteous','Risque','Roboto','Roboto Condensed','Roboto Mono','Roboto Slab','Rochester','Rock Salt','Rokkitt','Romanesco','Ropa Sans','Rosario','Rosarivo','Rouge Script','Rozha One','Rubik','Rubik Mono One','Rubik One','Ruda','Rufina','Ruge Boogie','Ruluko','Rum Raisin','Ruslan Display','Russo One','Ruthie','Rye','Sacramento','Sahitya','Sail','Salsa','Sanchez','Sancreek','Sansita One','Sarala','Sarina','Sarpanch','Satisfy','Scada','Scheherazade','Schoolbell','Seaweed Script','Sevillana','Seymour One','Shadows Into Light','Shadows Into Light Two','Shanti','Share','Share Tech','Share Tech Mono','Shojumaru','Short Stack','Siemreap','Sigmar One','Signika','Signika Negative','Simonetta','Sintony','Sirin Stencil','Six Caps','Skranji','Slabo 13px','Slabo 27px','Slackey','Smokum','Smythe','Sniglet','Snippet','Snowburst One','Sofadi One','Sofia','Sonsie One','Sorts Mill Goudy','Source Code','Source Sans','Source Serif','Special Elite','Spicy Rice','Spinnaker','Spirax','Squada One','Sree Krushnadevaraya','Stalemate','Stalinist One','Stardos Stencil','Stint Ultra Condensed','Stint Ultra Expanded','Stoke','Strait','Sue Ellen Francisco','Sumana','Sunshiney','Supermercado One','Sura','Suranna','Suravaram','Suwannaphum','Swanky and Moo Moo','Syncopate','Tangerine','Taprom','Tauri','Teko','Telex','Tenali Ramakrishna','Tenor Sans','Text Me One','The Girl Next Door','Tienne','Tillana','Timmana','Tinos','Titan One','Titillium Web','Trade Winds','Trocchi','Trochut','Trykker','Tulpen One','Ubuntu','Ubuntu Condensed','Ubuntu Mono','Ultra','Uncial Antiqua','Underdog','Unica One','UnifrakturCook','UnifrakturMaguntia','Unkempt','Unlock','Unna','VT323','Vampiro One','Varela','Varela Round','Vast Shadow','Vesper Libre','Vibur','Vidaloka','Viga','Voces','Volkhov','Vollkorn','Voltaire','Waiting for the Sunrise','Wallpoet','Walter Turncoat','Warnes','Wellfleet','Wendy One','Wire One','Work Sans','Yanone Kaffeesatz','Yantramanav','Yellowtail','Yeseva One','Yesteryear','Zeyada');
      $iepa_mm_font_family = get_option( 'iepa_mm_font_family' );
      if ( empty( $iepa_mm_font_family ) ) {
        update_option( 'iepa_mm_font_family', $family );
      }

      IEPA_MM_Menu_Settings::iepa_mm_menu_item_defaults();
      /*
      * Available Skin Themes
      */
      $available_skin = array(
        '0' => array('title' => 'Black & White',
         'id' => 'black-white' ,
         'color' => '#000000',
         ),
        '1' =>
        array('title' => 'Gold Yellowish',
         'id' => 'gold-yellow-black',
         'color' => '#dace2e'
         ),
        '2' =>
        array('title' => 'Hunter Shades',
         'id' => 'hunter-shades-white',
         'color' => '#CFA66F'
         ),
        '3' =>
        array('title' => 'Maroon Reddish',
         'id' => 'maroon-reddish-black',
         'color' => '#800000'
         ),
        '4' =>
        array('title' => 'Light Blue Sky',
         'id' => 'light-blue-sky-white' ,
         'color' => '#0AA2EE'
         ),
        '5' =>
        array('title' => 'Warm Purple',
         'id' => 'warm-purple-white',
         'color' => '#9768a8'
         ),
        '6' =>
        array('title' => 'SeaGreen',
         'id' => 'sea-green-white',
         'color' => '#2E8B57'
         ),
        '7' =>
        array('title' => 'Clean White',
         'id' => 'clean-white',
         'color' => '#fff'
         ),
        '8' =>
        array('title' => 'Black & Silver',
         'id' => 'black-silver',
         'color' => '#888'
         ),
        '9' =>
        array('title' => 'Transparent With Hover Black',
         'id' => 'transparent-hover-black',
         'color' => '#323232'
         ),
        '10' =>
        array('title' => 'Prussian Blue',
         'id' => 'prussian-blue-white',
         'color' => '#003153'
         ),
        '11' =>
        array('title' => 'Mountain Meadow',
         'id' => 'mountain-meadow-white',
         'color' => '#30ba8f'
         ),
        '12' =>
        array('title' => 'Dark Blue',
         'id' => 'white-blue',
         'color' => '#0056c7'
         ),
        '13' =>
        array('title' => 'Simple Green',
         'id' => 'simple-green',
         'color' => '#570'
         )
         );
      $available_skin_themes = get_option( 'iepa_mm_register_skin' );
      if ( empty( $available_skin_themes ) ) {
       update_option( 'iepa_mm_register_skin', $available_skin );
      }
    }

    /**
     * Returns Default Settings
     */
    public static function iepa_mm_default_settings() {
      $iepamega_settings = array(
        'advanced_click'            =>  'click_submenu',
        'mlabel_animation_type'     =>  'none',
        'animation_delay'           =>  '2s',
        'animation_duration'        =>  '3s',
        'animation_iteration_count' =>  '1',
        'enable_mobile'             =>  '0',
        'enable_rtl'                =>  '0',
        'disable_submenu_retractor' =>  0,
        'mobile_toggle_option'      =>  'toggle_standard',
        'image_size'                =>  'thumbnail',
        'hide_icons'                =>  0,
        'custom_width'              =>  '',
        'close_menu_icon'           =>  'dashicons dashicons-no',
        'open_menu_icon'            =>  'dashicons dashicons-menu',
        'icon_width'                =>  '13px',
        'active_sticky_menu'        =>  '0',
        'sticky_theme_location'     =>  '',
        // 'transition_style' => 'fade',//fade ,slide
        'sticky_on_mobile'          =>  '1',
        'sticky_opacity'            =>  '1',
        'sticky_zindex'             =>  '9999',
        'choose_woo_cart_display'   =>  'both_pi',
        'cart_display_pattern'      =>  '(#price)#item_count items',
      );
      return $iepamega_settings;
    }


  }
  new IEPA_MM_Activation();
}

<?php
/**
 * Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

/**
 * Text domain definition
 */
function floaat_scripts()
{

    wp_deregister_script('jquery');
    wp_register_script('jquery', ("http://code.jquery.com/jquery-1.11.0.min.js"), false, '2.1.1');
    wp_enqueue_script('jquery');

    wp_enqueue_script("bundle", get_stylesheet_directory_uri() . "/js/bundle.js", array(), 1, true);

    wp_enqueue_style("style", get_stylesheet_directory_uri() . "/css/style.css");

    // Localize script
    $theme_vars = array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    );
    wp_localize_script('bundle', 'themeVars', $theme_vars);
}

add_action('wp_enqueue_scripts', 'floaat_scripts');

// Register navigation menus

add_action('after_setup_theme', 'register_theme_menus');
function register_theme_menus()
{
    register_nav_menus(array(
        'primary' => __('Primary Menu'),
        'footer_menu' => __('Footer Menu')
    ));
}

// Disable the theme / plugin text editor in Admin
//define('DISALLOW_FILE_EDIT', true);

// ACF Options Pages
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(array(
        'menu_title' => 'Theme Options',
        'menu_slug' => 'theme-general-settings',
        'capability' => 'edit_posts',
        'redirect' => true
    ));
}


//custom menu

class custom_walker_nav_menu extends Walker_Nav_Menu
{

    /**
     * @see Walker::start_lvl()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int $depth Depth of page. Used for padding.
     */
    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul role=\"menu\" class=\" dropdown-menu\">\n";
    }

    /**
     * @see Walker::start_el()
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param object $item Menu item data object.
     * @param int $depth Depth of menu item. Used for padding.
     * @param int $current_page Menu item ID.
     * @param object $args
     */
    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';

        /**
         * Dividers, Headers or Disabled
         * =============================
         * Determine whether the item is a Divider, Header, Disabled or regular
         * menu item. To prevent errors we use the strcasecmp() function to so a
         * comparison that is not case sensitive. The strcasecmp() function returns
         * a 0 if the strings are equal.
         */
        if (strcasecmp($item->attr_title, 'divider') == 0 && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="divider">';
        } else if (strcasecmp($item->title, 'divider') == 0 && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="divider">';
        } else if (strcasecmp($item->attr_title, 'dropdown-header') == 0 && $depth === 1) {
            $output .= $indent . '<li role="presentation" class="dropdown-header">' . esc_attr($item->title);
        } else if (strcasecmp($item->attr_title, 'disabled') == 0) {
            $output .= $indent . '<li role="presentation" class="disabled"><a href="#">' . esc_attr($item->title) . '</a>';
        } else {

            $class_names = $value = '';

            $classes = empty($item->classes) ? array() : (array)$item->classes;
            $classes[] = 'menu-item-' . $item->ID;

            $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));

            if ($args->has_children)
                $class_names .= ' dropdown';

            if (in_array('current-menu-item', $classes))
                $class_names .= ' active';

            $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

            $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
            $id = $id ? ' id="' . esc_attr($id) . '"' : '';

            $output .= $indent . '<li' . $id . $value . $class_names . '>';

            $atts = array();
            $atts['title'] = !empty($item->title) ? $item->title : '';
            $atts['target'] = !empty($item->target) ? $item->target : '';
            $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';

            // If item has_children add atts to a.
            if ($args->has_children && $depth === 0) {
                $atts['href'] = '#';
                $atts['data-toggle'] = 'dropdown';
                $atts['class'] = 'dropdown-toggle';
                $atts['aria-haspopup'] = 'true';
            } else {
                $atts['href'] = !empty($item->url) ? $item->url : '';
            }

            $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

            $attributes = '';
            foreach ($atts as $attr => $value) {
                if (!empty($value)) {
                    $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                    $attributes .= ' ' . $attr . '="' . $value . '"';
                }
            }

            $item_output = $args->before;

            /*
             * Glyphicons
             * ===========
             * Since the the menu item is NOT a Divider or Header we check the see
             * if there is a value in the attr_title property. If the attr_title
             * property is NOT null we apply it as the class name for the glyphicon.
             */
            if (!empty($item->attr_title))
                $item_output .= '<a' . $attributes . '><span class="glyphicon ' . esc_attr($item->attr_title) . '"></span>&nbsp;';
            else
                $item_output .= '<a' . $attributes . '>';

            $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
            $item_output .= ($args->has_children && 0 === $depth) ? ' <span class="caret"></span></a>' : '</a>';
            $item_output .= $args->after;

            $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
        }
    }

    /**
     * Traverse elements to create list from elements.
     *
     * Display one element if the element doesn't have any children otherwise,
     * display the element and its children. Will only traverse up to the max
     * depth and no ignore elements under that depth.
     *
     * This method shouldn't be called directly, use the walk() method instead.
     *
     * @see Walker::start_el()
     * @since 2.5.0
     *
     * @param object $element Data object
     * @param array $children_elements List of elements to continue traversing.
     * @param int $max_depth Max depth to traverse.
     * @param int $depth Depth of current element.
     * @param array $args
     * @param string $output Passed by reference. Used to append additional content.
     * @return null Null on failure with no changes to parameters.
     */
    public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
    {
        if (!$element)
            return;

        $id_field = $this->db_fields['id'];

        // Display this element.
        if (is_object($args[0]))
            $args[0]->has_children = !empty($children_elements[$element->$id_field]);

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }

    /**
     * Menu Fallback
     * =============
     * If this function is assigned to the wp_nav_menu's fallback_cb variable
     * and a manu has not been assigned to the theme location in the WordPress
     * menu manager the function with display nothing to a non-logged in user,
     * and will add a link to the WordPress menu manager if logged in as an admin.
     *
     * @param array $args passed from the wp_nav_menu function.
     *
     */
    public static function fallback($args)
    {
        if (current_user_can('manage_options')) {

            extract($args);

            $fb_output = null;

            if ($container) {
                $fb_output = '<' . $container;

                if ($container_id)
                    $fb_output .= ' id="' . $container_id . '"';

                if ($container_class)
                    $fb_output .= ' class="' . $container_class . '"';

                $fb_output .= '>';
            }

            $fb_output .= '<ul';

            if ($menu_id)
                $fb_output .= ' id="' . $menu_id . '"';

            if ($menu_class)
                $fb_output .= ' class="' . $menu_class . '"';

            $fb_output .= '>';
            $fb_output .= '<li><a href="' . admin_url('nav-menus.php') . '">Add a menu</a></li>';
            $fb_output .= '</ul>';

            if ($container)
                $fb_output .= '</' . $container . '>';

            echo $fb_output;
        }
    }
}

// Walker_Nav_Menu

function bike_social($class)
{
    $social = get_field('social', 'option');
    $html = '<ul class="' . $class . '">';

    if ($social) {
        foreach ($social as $soc) {
            $html .= '<li><a href="' . $soc['link'] . '">' . $soc['icon'] . '</a></li>';
        }
    }

    $html .= '</ul>';
    return $html;
}

add_theme_support('woocommerce');


// price in hrn
function get_price_multiplier($prise)
{
    if (empty($dollar_rate = get_transient('dollar_rate'))) {
        $result = CallAPI('https://api.privatbank.ua/p24api/pubinfo?exchange&json&coursid=11');
        $json = json_decode($result, true);
        $dollar_rate = $json[0]['sale'];
        // save value in DB on 1 day
        set_transient('dollar_rate', $dollar_rate, 86000);
    };

    $dollar_rate = number_format(round($dollar_rate * $prise), $decimals = 2, $dec_point = ".", $thousands_sep = ",");
    return $dollar_rate;
}

function bike_change_product_price_display($price_tag)
{
    global $product;
    $id = $product->get_id();
    $product = wc_get_product($id);

    $regular = $product->get_regular_price();
    $sale = $product->get_sale_price();
    if ($sale) {
        $price_tag .= '<p class="price custom"><del><span class="woocommerce-Price-amount amount">(' . get_price_multiplier($regular) . '<span class="woocommerce-Price-currencySymbol">₴)</span></span></del> <ins><span class="woocommerce-Price-amount amount">' . get_price_multiplier($sale) . '<span class="woocommerce-Price-currencySymbol">₴</span></span></ins></p>';
    } else {
        $price_tag .= '<p class="woocommerce-Price-amount amount">(' . get_price_multiplier($regular) . '<span class="woocommerce-Price-currencySymbol">₴)</span></p>';
    }
    return $price_tag;
}

add_filter('woocommerce_get_price_html', 'bike_change_product_price_display');
add_filter('woocommerce_cart_item_price', 'bike_change_product_price_display');


function CallAPI($url)
{
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_POST, 1);

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

// filter-post


function filter_post_asb()
{
    $of = array(
        'year' => gmdate("Y", $_POST['of']),
        'month' => gmdate("m", $_POST['of']),
        'day' => gmdate("d", $_POST['of']),
    );
    $and = array(
        'year' => gmdate("Y", $_POST['and']),
        'month' => gmdate("m", $_POST['and']),
        'day' => gmdate("d", $_POST['and']),
    );

    $args = array(
        'post_type' => 'filter',
        'orderby' => 'date',
        'order' => 'DESC',
        'date_query' => array(
            array(
                'after' => array( // после этой даты
                    'year' => $of['year'],
                    'month' => $of['month'],
                    'day' => $of['day'],
                ),
                'before' => array( // до этой даты
                    'year' => $and['year'],
                    'month' => $and['month'],
                    'day' => $and['day'],
                ),
                // 'inclusive'=> true
            )
        )
    );
    $query = new WP_Query($args);
    if ($query->have_posts()) :
        ?>
        <?php while ($query->have_posts()) : $query->the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <header class="entry-header">
                <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');?>
                <img src="<?php the_post_thumbnail_url([100, 100]); ?>" alt="">
            </header><!-- .entry-header -->
        </article><!-- #post-## --><?php
    endwhile; ?>
        <?php wp_reset_postdata(); ?>
    <?php
    endif;
    exit;
}

add_action('wp_ajax_filter', 'filter_post_asb');
add_action('wp_ajax_nopriv_filter', 'filter_post_asb');
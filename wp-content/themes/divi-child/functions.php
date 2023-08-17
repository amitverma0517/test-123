<?php
function my_theme_enqueue_styles() {
wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );





/**-- Breadcrumb shortcode ---------------**/
function get_breadcrumb() {
ob_start();
   echo '<a href="'.home_url().'" rel="nofollow">Home</a>';
   if (is_category() || is_single()) {
       echo "&nbsp; / &nbsp; "; 
       the_category(' &bull; ');
           if (is_single()) {
               echo " &nbsp;&nbsp;/&nbsp;&nbsp; ";
               the_title();
           }
   } elseif (is_page()) {
       echo "&nbsp;&nbsp;/&nbsp;&nbsp;";
       echo the_title();
   } elseif (is_search()) {
       echo "&nbsp;&nbsp;/&nbsp;&nbsp;Search Results for... ";
       echo '"<em>';
       echo the_search_query();
       echo '</em>"';
   }
   return ob_get_clean();
}

add_shortcode( 'breadcrumb', 'get_breadcrumb' );
/**-- Breadcrumb shortcode ---------------**/





/** Dynamic Year Code Use and Footer copyright support code **/
function year_shortcode() {
  $year = date('Y');
  return $year;
}
add_shortcode('year', 'year_shortcode');


function bloginfoSC( $atts ) {
             extract(shortcode_atts(array(       'value' => '',   ), $atts));
             return get_bloginfo($value);
}
 
add_shortcode('bloginfo', 'bloginfoSC');

/** Dynamic Year Code Use and Footer copyright support code 
[bloginfo value='name']
[bloginfo value='url']
**/






/* Place Below  Dynamic Footer Code */
/* Start Here */
add_action('wp_footer', 'your_function_name');
function your_function_name(){
?>
<script>
(function($) { 
    function setup_collapsible_submenus() {
        // mobile menu
        $('.mobile_nav .menu-item-has-children > a').after('<span class="menu-closed"></span>');
        $('.mobile_nav .menu-item-has-children > a').each(function() {
            $(this).next().next('.sub-menu').toggleClass('hide',1000);
        });
        $('.mobile_nav .menu-item-has-children > a + span').on('click', function(event) {
            event.preventDefault();
            $(this).toggleClass('menu-open');
            $(this).next('.sub-menu').toggleClass('hide',1000);
        });
    }
    $(window).load(function() {
        setTimeout(function() {
            setup_collapsible_submenus();
        }, 700);
    });
})(jQuery);
</script>


<?php
};
/* Ends Here */




/** Disable the emoji's*************************************************************************************/
function disable_emojis() {
 remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
 remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
 remove_action( 'wp_print_styles', 'print_emoji_styles' );
 remove_action( 'admin_print_styles', 'print_emoji_styles' ); 
 remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
 remove_filter( 'comment_text_rss', 'wp_staticize_emoji' ); 
 remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
 add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );
 add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
add_action( 'init', 'disable_emojis' );

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param array $plugins 
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce( $plugins ) {
 if ( is_array( $plugins ) ) {
 return array_diff( $plugins, array( 'wpemoji' ) );
 } else {
 return array();
 }
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch( $urls, $relation_type ) {
 if ( 'dns-prefetch' == $relation_type ) {
 /** This filter is documented in wp-includes/formatting.php */
 $emoji_svg_url = apply_filters( 'emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/' );

$urls = array_diff( $urls, array( $emoji_svg_url ) );
 }

return $urls;
}
/** Disable the emoji's*************************************************************************************/



/** HTML MINIFICATION CODE************************************************************************************/
add_action('wp', 'page_check'); function page_check() {
if (is_page('seo')) {} 
elseif(!(is_user_logged_in())) { 
class FLHM_HTML_Compression
{
protected $flhm_compress_css = true;
protected $flhm_compress_js = false;
protected $flhm_info_comment = true;
protected $flhm_remove_comments = true;
protected $html;
public function __construct($html)
{
if (!empty($html))
{
$this->flhm_parseHTML($html);
}
}
public function __toString()
{
return $this->html;
}
protected function flhm_bottomComment($raw, $compressed)
{
$raw = strlen($raw);
$compressed = strlen($compressed);
$savings = ($raw-$compressed) / $raw * 100;
$savings = round($savings, 2);
return '<!--HTML compressed, size saved '.$savings.'%. From '.$raw.' bytes, now '.$compressed.' bytes-->';
}
protected function flhm_minifyHTML($html)
{
$pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
$overriding = false;
$raw_tag = false;
$html = '';
foreach ($matches as $token)
{
$tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
$content = $token[0];
if (is_null($tag))
{
if ( !empty($token['script']) )
{
$strip = $this->flhm_compress_js;
}
else if ( !empty($token['style']) )
{
$strip = $this->flhm_compress_css;
}
else if ($content == '<!--wp-html-compression no compression-->')
{
$overriding = !$overriding;
continue;
}
else if ($this->flhm_remove_comments)
{
if (!$overriding && $raw_tag != 'textarea')
{
$content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
}
}
}
else
{
if ($tag == 'pre' || $tag == 'textarea')
{
$raw_tag = $tag;
}
else if ($tag == '/pre' || $tag == '/textarea')
{
$raw_tag = false;
}
else
{
if ($raw_tag || $overriding)
{
$strip = false;
}
else
{
$strip = true;
$content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
$content = str_replace(' />', '/>', $content);
}
}
}
if ($strip)
{
$content = $this->flhm_removeWhiteSpace($content);
}
$html .= $content;
}
return $html;
}
public function flhm_parseHTML($html)
{
$this->html = $this->flhm_minifyHTML($html);
if ($this->flhm_info_comment)
{
$this->html .= "\n" . $this->flhm_bottomComment($html, $this->html);
}

}
protected function flhm_removeWhiteSpace($str)
{
$str = str_replace("\t", ' ', $str);
$str = str_replace("\n",  '', $str);
$str = str_replace("\r",  '', $str);
while (stristr($str, '  '))
{
$str = str_replace('  ', ' ', $str);
}  
return $str;
}
}
function flhm_wp_html_compression_finish($html)
{
return new FLHM_HTML_Compression($html);
}
function flhm_wp_html_compression_start()
{
ob_start('flhm_wp_html_compression_finish');
}
add_action('get_header', 'flhm_wp_html_compression_start');
}  } 

/** HTML MINIFICATION CODE*************************************************************************************/





/* Place Js File in Footer */
function oiw_remove_head_scripts() {
remove_action('wp_head', 'wp_print_scripts');
remove_action('wp_head', 'wp_print_head_scripts', 9);
remove_action('wp_head', 'wp_enqueue_scripts', 1);
 
add_action('wp_footer', 'wp_print_scripts', 5);
add_action('wp_footer', 'wp_enqueue_scripts', 5);
add_action('wp_footer', 'wp_print_head_scripts', 1);
}
add_action( 'wp_enqueue_scripts', 'oiw_remove_head_scripts' );
/* Place Js File in Footer */





/** Use All custon js in  /js/own_custom.js **/

 function prince_scripts() {
wp_enqueue_script( 'prince-script', get_stylesheet_directory_uri(). '/js/own_custom.js');

}
add_action( 'wp_enqueue_scripts', 'prince_scripts');

/** Use All custon js in  /js/own_custom.js **/
<?php
/*
* Plugin Name: Hello Cricket
* Plugin URI: https://github.com/mskian/hello-cricket
* Description: Simple Plugin to Display Live Cricket Score on your Wordpress site.
* Version: 1.0
* Author: Santhosh veer
* Author URI: https://sanweb.info/
* License: GPLv3
* License URI: http://www.gnu.org/licenses/gpl.html
*/

## register admin script
add_action( 'admin_enqueue_scripts', 'hellocri_enqueue_color_picker' );
function hellocri_enqueue_color_picker() {
wp_enqueue_style('wp-color-picker');
wp_enqueue_script('hellocri-color-picker', plugin_dir_url( __FILE__ ) . 'assets/js/color.js', array( 'wp-color-picker' ), false);
}

## CSS for Scorecard
add_action('wp_head','hellockt_css');
function hellockt_css() {
$bg_color = get_option('hellocri_bg_color');
$bg_text = get_option('hellocri_text_color');
$output="<style>
#hello-score {
  background-color: $bg_color;
  color: $bg_text;
  padding: 20px;
  margin: 20px;
  border-radius:12px;
  font-size: 15px;
  box-shadow: 4px 4px 10px #e3e3e3;
}
</style>";
echo $output;
}

## plugin open registration
function activate_hellocri() {
  add_option('hellocri_bg_color', '#7158e2');
  add_option('hellocri_text_color', '#ffffff');
}

## Regsister user input
function admin_init_mmhellocricket() {
  register_setting('hellocric_mskc_topt', 'hellocric_match_url');
  register_setting('hellocric_mskc_topt', 'hellocri_bg_color');
  register_setting('hellocric_mskc_topt', 'hellocri_text_color');
}

## Setup Admin Page
function admin_menu_mmhellocricket() {
  add_options_page('Hello Cricket', 'Hello Cricket', 'manage_options', 'hellocricket_mskc_topt', 'options_page_mmhellocricket');
}

## plugin register hooks
register_activation_hook(__FILE__, 'activate_hellocri');

## init Admin
if (is_admin()) {
  add_action('admin_init', 'admin_init_mmhellocricket');
  add_action('admin_menu', 'admin_menu_mmhellocricket');

}

## Options Page
function options_page_mmhellocricket() {
  include( plugin_dir_path( __FILE__ ) .'options.php');
}

## Shortcode to Display Score
function wpb_hellocric_shortcode(){

  ## Check Empty Input
  if (empty(get_option('hellocric_match_url'))) {
    return '<div id="hello-score">Match URL Not Found</div>';
  }

  ## Get Score URL
  $match_url = get_option('hellocric_match_url');
 
  ## Generate Scorecard
  $scorecard = "<script>
     async function fetchscore() {
       const helloCricketClass = document.getElementsByClassName('hello_cricket');
         try {
             const response = await fetch('https://cricket-api.vercel.app/cri.php?url=$match_url');
             const data = await response.json();
             console.log(data);
             if (data === false || data === '') {
               if (helloCricketClass != null) {
                 let score_msg = '<p>Match URL Empty</p>';
                  score_text(helloCricketClass, score_msg);
              }
             } else if (helloCricketClass != null) {
                 let score_msg = '🏏 Match: \t' + data.livescore.title +'<br><br>📊 Status: \t' + data.livescore.update +'<br>🔴 Live: \t' + data.livescore.current +'<br>📉 Run Rate: \t' + data.livescore.runrate +'<br><br>✅ Current Batsman: \t' + data.livescore.batsman +' \t '+ data.livescore.batsmanrun + data.livescore.ballsfaced +' Balls<br>✅ Current Bowler: \t' + data.livescore.bowler +' \t '+ data.livescore.bowlerover +' ('+ data.livescore.bowlerruns +' Run)<br>';
                 score_text(helloCricketClass, score_msg);
             }
         } catch (exception) {
             if (helloCricketClass != null) {
                 let score_msg = '<p>Connection Lost or Enter a valid Match URL</p>';
                 score_text(helloCricketClass, score_msg);
             }
         }
     }
     function score_text(helloCricketClass, text) {
       for (let i = 0; i < helloCricketClass.length; i++) {
         helloCricketClass[i].innerHTML = '<p>Fetching the Live Score 📦</p>';
         setTimeout(() => {
             helloCricketClass[i].innerHTML = text;
         }, 1000);
       }
     }
     fetchscore();
     setInterval(fetchscore, 60 * 2000);
    </script>
    <div class=\"hello_cricket\" id=\"hello-score\"></div>";

   ## Print Scorecard via Shortcode
   return $scorecard;
}
add_shortcode('hellocricket', 'wpb_hellocric_shortcode');

## Settings Page link
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'hellocrikt_optge_links' );

function hellocrikt_optge_links ( $helloclinks ) {
 $myhelloclinks = array(
 '<a href="' . admin_url( 'options-general.php?page=hellocricket_mskc_topt' ) . '">Plugin Settings</a>',
 );
return array_merge( $helloclinks, $myhelloclinks );
}

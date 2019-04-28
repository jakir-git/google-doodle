<?php
/**
 * Plugin Name: Google Doodle
 * Plugin URI: 
 * Description: Google Doodle is a free WordPress Plugin that show google doodle on your website as popup.
 * Author: Jakir Hosen
 * Version: 1.0
 * Author URI: 
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_action( 'wp_footer', function(){
	?>
	<div class="doodle-wrap">
        <div class="doodle-popup-wrap">
           <span class="close-btn">&times;</span>
           <div id="doodle-title"></div>
            <a target="_blank" id="doodle-link" href="">
                <img src="" id="doodle-img-tag" alt="">
            </a>
        </div>
	</div>
	<?php
});

add_action( 'wp_footer', 'doodle_header_scripts' );
function doodle_header_scripts(){
  ?>
  <script>
        let title = document.getElementById('doodle-title');
        let proxy = 'https://cors-anywhere.herokuapp.com/';
        let url = proxy+'https://www.google.com/doodles';
        let body = document.createElement('body')

        fetch(url)
        .then(function(response) {
            return response.text();
        })
        .then(function(text) {
            body.innerHTML = text;
                let doodleImg = body.querySelector('#latest .container img');
                let doodleLink = body.querySelector('#latest .container a');
                let imgSrc = doodleImg.getAttribute('src').slice(2);
                let imgName = doodleImg.getAttribute('alt');
                let imgLink = doodleLink.getAttribute('href');
                let link = 'http://';
                let googleLink = 'https://www.google.com';
                let doodlePreview = link.concat(imgSrc);
                let doodleSrcLink = googleLink.concat(imgLink);
                //console.log({doodlePreview, imgName, doodleSrcLink});

                //Create img tag
                let imgTag = document.getElementById('doodle-img-tag');
                let linkTag = document.getElementById('doodle-link');
                imgTag.setAttribute("src", doodlePreview);
                linkTag.setAttribute("alt", imgName);
                imgTag.setAttribute("alt", imgName);
                linkTag.setAttribute("href", doodleSrcLink);
                title.innerHTML = imgName;
        })
        
    </script>
  <?php
}

add_action('wp_enqueue_scripts', function(){
    wp_enqueue_script('jquery-cookie', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.0/jquery.cookie.js', array('jquery'));
    wp_enqueue_script('plugin-js', plugins_url( ) .'/google-doodle/assets/js/plugin.js', array('jquery'));
	wp_enqueue_style('plugin-css', plugins_url( ) .'/google-doodle/assets/css/style.css');
});
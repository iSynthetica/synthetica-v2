<?php
/**
 * Shortcodes Library
 *
 * Add new shortcode:
 * file: includes/settings.php
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$shortcodes = apply_filters( 'snth_shortcodes', array() );

foreach($shortcodes as $shortcode) {
    add_shortcode( $shortcode['id'], $shortcode['callback'] );
}

function snth_widget_additional_links() {
    ob_start();
    ?>
    <ul class="list-unstyled">
        <li><a class="text-small" href="home-classic-corporate.html">Home Classic Corporate</a></li>
        <li><a class="text-small" href="home-creative-business.html">Home Creative Business</a></li>
        <li><a class="text-small" href="home-creative-designer.html">Home Creative Designer</a></li>
        <li><a class="text-small" href="home-portfolio-minimal.html">Home Portfolio Minimal</a></li>
        <li><a class="text-small" href="home-portfolio-parallax.html">Home Portfolio  parallax</a></li>
        <li><a class="text-small" href="home-portfolio-personal.html">Home Portfolio Personal</a></li>
    </ul>
    <?php
    return ob_get_clean();
}

function snth_widget_contact_info() {
    ob_start();
    ?>
    <p class="text-small d-block margin-15px-bottom width-80 sm-width-100">POFO Design Agency<br> 301 The Greenhouse, Custard Factory, London, E2 8DY.</p>
    <div class="text-small">Email: <a href="mailto:sales@domain.com">i.synthetica@gmail.com</a></div>
    <div class="text-small">Phone: +44 (0) 123 456 7890</div>
    <a href="contact-us-modern.html" class="text-small text-uppercase text-decoration-underline">View Direction</a>
    <?php
    return ob_get_clean();
}

function snth_widget_instagram() {
    ob_start();
    ?>
    <div class="instagram-follow-api">
        <ul id="instaFeed-footer"></ul>
    </div>
    <?php
    return ob_get_clean();
}

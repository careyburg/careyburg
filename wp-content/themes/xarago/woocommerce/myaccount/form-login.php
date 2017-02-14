<?php
/**
 * Login Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/form-login.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
        <section class="uk-padding">
            <div class="uk-container uk-container-center">
                
                <div class="uk-grid">
                
                    <div class="uk-width-4-10 uk-width-small-1-1 uk-margin-large-top uk-margin-large-bottom uk-container-center">
                        
                        <?php wc_print_notices(); ?>
                        
                        <div class="uk-tab-center">
                            <ul class="uk-tab" data-uk-tab="{connect:'#tab-top-content'}">
                                <li><a href=""><?php echo esc_html__('Login','xarago');?></a></li>
                                <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
                                <li><a href=""><?php echo esc_html__('Register','xarago');?></a></li>
                                <?php endif;?>
                            </ul>
                        </div>
                        <ul id="tab-top-content" class="uk-switcher uk-margin">
                            <li>
                                <form id="login-account" method="post" class="login">
                                    <fieldset>
                        			<?php do_action( 'woocommerce_login_form_start' ); ?>
                                    
                                    <div class="uk-form-icon">
                                        <i class="uk-icon-user"></i>
                                        <input type="text" placeholder="Username" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>">
                                    </div>
                                    <div class="uk-form-icon">
                                        <i class="uk-icon-key"></i>
                                        <input type="text" placeholder="Password">
                                    </div>
                        
                        			<?php do_action( 'woocommerce_login_form' ); ?>
                        			<p class="form-row">
                        				<?php wp_nonce_field( 'woocommerce-login', 'woocommerce-login-nonce' ); ?>
                        				<input type="submit" class="woocommerce-Button button uk-width-1-1" name="login" value="<?php esc_attr_e( 'Login', 'xarago' ); ?>" />
                        				<label for="rememberme" class="inline">
                        					<input class="woocommerce-Input woocommerce-Input--checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'xarago' ); ?>
                        				</label>
                        			</p>
                        			<p class="woocommerce-LostPassword lost_password">
                        				<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'xarago' ); ?></a>
                        			</p>
                        
                        			<?php do_action( 'woocommerce_login_form_end' ); ?>
                                    </fieldset>
                        		</form>
                            </li>
                            <?php if ( get_option( 'woocommerce_enable_myaccount_registration' ) === 'yes' ) : ?>
                            <li>
                                <form method="post"  id="register-account"  class="register">
                                    <fieldset>
                        			<?php do_action( 'woocommerce_register_form_start' ); ?>
                        
                        			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_username' ) ) : ?>
                                        <div class="uk-form-icon">
                                            <i class="uk-icon-user"></i>
                                            <input type="text" class="woocommerce-Input woocommerce-Input--text input-text" name="username" id="reg_username" value="<?php if ( ! empty( $_POST['username'] ) ) echo esc_attr( $_POST['username'] ); ?>" placeholder="Username" />                                            
                                        </div>                                                                
                        
                        			<?php endif; ?>
                                    
                                    <div class="uk-form-icon">
                                        <i class="uk-icon-envelope"></i>
                                        <input type="email" class="woocommerce-Input woocommerce-Input--text input-text uk-form-large uk-width-1-1" name="email" id="reg_email" value="<?php if ( ! empty( $_POST['email'] ) ) echo esc_attr( $_POST['email'] ); ?>" placeholder="Email address"/>                                            
                                    </div>
                                                            
                        			<?php if ( 'no' === get_option( 'woocommerce_registration_generate_password' ) ) : ?>
                                        
                                        <div class="uk-form-icon">
                                            <i class="uk-icon-key"></i>
                                            <input type="password" class="woocommerce-Input woocommerce-Input--text input-text uk-width-1-1 uk-form-large " name="password" id="reg_password" placeholder="Password"/>
                                        </div>
                        
                        			<?php endif; ?>
                        
                        			<!-- Spam Trap -->
                        			<div style="<?php echo ( ( is_rtl() ) ? 'right' : 'left' ); ?>: -999em; position: absolute;"><label for="trap"><?php _e( 'Anti-spam', 'xarago' ); ?></label><input type="text" name="email_2" id="trap" tabindex="-1" /></div>
                        
                        			<?php do_action( 'woocommerce_register_form' ); ?>
                        			<?php do_action( 'register_form' ); ?>
                        
                        			<p class="woocomerce-FormRow form-row">
                        				<?php wp_nonce_field( 'woocommerce-register', 'woocommerce-register-nonce' ); ?>
                        				<input type="submit" class="woocommerce-Button button uk-width-1-1" name="register" value="<?php esc_attr_e( 'Register', 'xarago' ); ?>" />
                        			</p>
                        
                        			<?php do_action( 'woocommerce_register_form_end' ); ?>
                                    </fieldset>
                        		</form>
                            </li>
                            <?php endif;?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
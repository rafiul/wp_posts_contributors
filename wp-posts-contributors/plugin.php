<?php
/*
Plugin Name: WP Posts Contributors
Plugin URI: https://profiles.wordpress.org/rafiul17/#content-plugins
Description: A simple Posts Contrubutors plugin for rtCamp.
Version: 1.0
Author: B.M. Rafiul Alam
Author URI: https://profiles.wordpress.org/rafiul17/#content-plugins
Text Domain: rrr-plug
Domain Path: /languages
*/


class PostsContrubutors{
	

	public function __construct() {
		add_action('admin_init', array( $this,'rt_enqueue_style'));
		add_action('wp_enqueue_scripts', array( $this,'rt_enqueue_style'));
		add_action('admin_menu', array( $this, 'rt_add_meta_boxes'));
		add_action('add_meta_boxes', array($this, 'rt_add_meta_boxes'));
		add_action('save_post', array( $this, 'save_contributor'), 10, 2);
	}

	public function rt_enqueue_style() {
		wp_enqueue_style('rt-preview', plugin_dir_url( __FILE__ ) . 'plugin-style.css', array());
	}

	public function rt_add_meta_boxes() {
		remove_meta_box('authordiv', 'post', 'normal');
		add_meta_box('rt_authordiv', __('Contributors'), array($this,'rt_post_author_meta_box'), 'post', 'side', 'default');
	}
	public function rt_post_author_meta_box($post) {
		 global $post;    
		$args = array('orderby' => 'ID', 'order' => 'ASC');
		$user_query = new WP_User_Query($args);
		// User Loop
		if (!empty($user_query->get_results())) {
			$count = 0;
			foreach ($user_query->get_results() as $user) {
				$user_id = $user->ID;
				//========= Get saved ID ============
				$get_meta = get_post_meta($post->ID, 'rt_post_author', true);
				$get_id="";
				if (!empty($get_meta[$count])) {
					$get_id = $get_meta[$count++];
				}
				wp_nonce_field('save_contributor', 'rt_nonce');
	?>
			<label id="label-<?php echo esc_attr($get_ID); ?>"><?php echo $user->display_name; ?></label>
			<input type="checkbox"  name="contributors[]" <?php if ($get_id == $user_id) {
					echo "checked";
				} ?> value="<?php echo esc_attr($user_id); ?>">
			
			<?php
			}
		} else {
			echo 'No users found.';
		}
	}
	public function save_contributor($post_id) {
		// Check if nonce is set
		if (!isset($_POST['rt_nonce'])) {
			return $post_id;
		}
		if (!wp_verify_nonce($_POST['rt_nonce'], 'save_contributor')) {
			return $post_id;
		}
		// Check that the logged in user has permission to edit this post
		if (!current_user_can('edit_post')) {
			return $post_id;
		}
		if (isset($_POST['contributors'])) {
			update_post_meta($post_id, 'rt_post_author', array_map('sanitize_text_field', $_POST['contributors']));
		}
	}

	//======Plugin Frontend View =========
	public function wp_posts_contributors_view($post_id) {
		$get_meta = get_post_meta($post_id, 'rt_post_author', true);
		if (!empty($get_meta)) {
	?>
		<div class="contributors-wraper">
			<h5><?php echo _e('Contributors:', 'rrr-plug'); ?></h5>
			<hr>
			<ul class="contributors">
				<?php
			if (is_array($get_meta)) {
				foreach ($get_meta as $id) {
					$user = get_user_by('ID', $id);?>
					<li>
						<a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta( 'ID' ) )); ?>"> 
						<div class="rt-avatar"><?php echo get_avatar($user, 55); ?></div> 
						<div class="contributor-name"><?php echo $user->display_name; ?></div>
						</a>
					</li>
				<?php
				}
			}
	?>
			</ul>
		</div>
	<?php
		}
	}

} //End Class

// Call class
 new PostsContrubutors();

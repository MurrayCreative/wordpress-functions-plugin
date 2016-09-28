			<!-- Clean Ups -->
			<div class="section-wrapper">
				<h2 class="section-title"><?php _e('Clean Up', $this->plugin_name);?></h2>

				<!-- Remove some meta and generators from the <head> -->
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e('Clean WordPress head section', $this->plugin_name);?></span></legend>
					<label for="<?php echo $this->plugin_name;?>-cleanup">
					<input type="checkbox" id="<?php echo $this->plugin_name;?>-cleanup" name="<?php echo $this->plugin_name;?>[cleanup]" value="1" <?php checked( $cleanup, 1 ); ?> />
					<span><?php esc_attr_e( 'Clean up the head section', $this->plugin_name ); ?></span>
					</label>
				</fieldset>


				<!-- Add post, page or product slug class to body class -->
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e('Add Post, page or product slug to body class', $this->plugin_name);?></span></legend>
					<label for="<?php echo $this->plugin_name;?>-body_class_slug">
					<input type="checkbox" id="<?php echo $this->plugin_name;?>-body_class_slug" name="<?php echo $this->plugin_name;?>[body_class_slug]" value="1" <?php checked( $body_class_slug, 1 ); ?>  />
					<span><?php esc_attr_e('Add Post slug to body class', $this->plugin_name);?></span>
					</label>
				</fieldset>


				<!-- Prettify Search URL -->
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e('Prettify Search URL - http://yourwebsite/search/search_terms/', $this->plugin_name);?></span></legend>
					<label for="<?php echo $this->plugin_name;?>-prettify_search">
						<input type="checkbox" id="<?php echo $this->plugin_name;?>-prettify_search" name="<?php echo $this->plugin_name;?>[prettify_search]" value="1" <?php checked($prettify_search, 1);?>/>
						<span><?php esc_attr_e('Prettify Search URL (eg: http://yourwebsite/search/search_terms/)', $this->plugin_name);?></span>
					</label>
				</fieldset>


				<!-- Hide Admin Bar -->
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e('Hide Admin Bar on the Front-end', $this->plugin_name);?></span></legend>
					<label for="<?php echo $this->plugin_name;?>-hide_admin_bar">
						<input type="checkbox" id="<?php echo $this->plugin_name;?>-hide_admin_bar" name="<?php echo $this->plugin_name;?>[hide_admin_bar]" value="1" <?php checked( $hide_admin_bar, 1);?>/>
						<span><?php esc_attr_e('Hide Admin Bar', $this->plugin_name);?></span>
					</label>
				</fieldset>


				<!-- Remove css and js query string versions -->
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e('Remove CSS and JS files query string versions', $this->plugin_name);?></span></legend>
					<label for="<?php echo $this->plugin_name;?>-css_js_versions">
						<input type="checkbox" id="<?php echo $this->plugin_name;?>-css_js_versions" name="<?php echo $this->plugin_name;?>[css_js_versions]" value="1" <?php checked($css_js_versions, 1);?>/>
						<span><?php esc_attr_e('Remove CSS and JS versions (uncheck for dev)', $this->plugin_name);?></span>
					</label>
				</fieldset>

				<?php submit_button(__('Save Changes', $this->plugin_name), 'primary','submit', TRUE); ?>
			</div>
			<!-- End of Clean Ups -->
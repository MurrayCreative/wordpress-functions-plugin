			<!-- Login page customizations -->
			<div class="section-wrapper">
				<h2 class="section-title"><?php _e('Login customization', $this->plugin_name);?></h2>

				<!-- Add client logo to login -->
				<fieldset>
					<h3 class="section-subheading"><?php _e('Add logo to login form', $this->plugin_name);?></h3>
					<p>Minimum dimensions 250 x 250 (width x height)</p>
					<legend class="screen-reader-text"><span><?php esc_attr_e('Login Logo', $this->plugin_name);?></span></legend>
					<label for="<?php echo $this->plugin_name;?>-login_logo">
					<input type="hidden" id="login_logo_id" name="<?php echo $this->plugin_name;?>[login_logo_id]" value="<?php echo $login_logo_id; ?>" />
					<input id="upload_login_logo_button" type="button" class="button" value="<?php _e( 'Upload Logo', $this->plugin_name); ?>" />
					<span><?php esc_attr_e('Login Logo', $this->plugin_name);?></span>
					</label>
					<div id="upload_logo_preview" class="studio-manager-upload-preview <?php if(empty($login_logo_id)) echo 'hidden'?>">
						<img src="<?php echo $login_logo_url; ?>" />
						<button id="studio-manager-delete_logo_button" class="studio-manager-delete-image" title="Remove Logo">X</button>
					</div>
				</fieldset>

				<!-- login logo link to homepage instead of wordpress.org -->
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e('Link Login Logo to homepage instead of WordPress.org', $this->plugin_name);?></span></legend>
					<label for="<?php echo $this->plugin_name;?>-login_logo_link">
						<input type="checkbox" id="<?php echo $this->plugin_name;?>-login_logo_link" name="<?php echo $this->plugin_name;?>[login_logo_link]" value="1" <?php checked($login_logo_link, 1);?>/>
						<span><?php esc_attr_e('Link Login Logo to homepage instead of WordPress.org', $this->plugin_name);?></span>
					</label>
				</fieldset>

				<?php submit_button(__('Save Changes', $this->plugin_name), 'primary','submit', TRUE); ?>
				</div>
				<!-- End of Login page customizations -->
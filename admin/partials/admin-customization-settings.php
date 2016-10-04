			<!-- Admin Customisations -->
			<div class="section-wrapper" id="section-admin">
				<h2 class="section-title"><?php _e('Admin Customisations', $this->plugin_name);?></h2>

				<!-- Hide WordPress admin menu items -->
				<fieldset class="studio_manager-admin-menu-items">
					<legend class="screen-reader-text"><span><?php _e('Hide Admin menu items for editors', $this->plugin_name);?></span></legend>
					<h3 class="section-subheading"><?php esc_attr_e('Hide Admin menu items for editors', $this->plugin_name);?></h3>
					<?php
						foreach($menu_items as $menu_item_key => $menu_item_val){
							if(isset($menu_item_val[0])){
								$all_menu_items[$menu_item_key] = $menu_item_val;
								$all_menu_items[$menu_item_key]['hidden'] = (isset($menu_items[$menu_item_key]['hidden'])) ? 1 : 0;
							}
						}
						
						foreach($all_menu_items as $menu_key => $menu_value):
							if($menu_value[0]):
								$re = "/(<span.*<\\/span>)/mi"; 
								$menu_label = preg_replace($re, '', $menu_value[0]);
								$menu_slug = $menu_value[2];
								$menu_arr = esc_html(serialize($menu_value));
								//$menu_arr = esc_html(json_encode($menu_value));
								?>
								<label for="<?php echo $this->plugin_name;?>-admin_menu_items_<?php echo $menu_slug;?>">
								<input type="checkbox" id="<?php echo $this->plugin_name;?>-admin_menu_items_<?php echo $menu_slug;?>" name="<?php echo $this->plugin_name;?>[admin_menu_items][<?php echo $menu_key; ?>]" value="1" <?php checked($menu_value['hidden'], 1);?>/>

								<input type="hidden" name="<?php echo $this->plugin_name;?>[admin_menu_items_val][<?php echo $menu_key; ?>]" value='<?php echo $menu_arr?>' >
								
								<span><?php esc_attr_e("Hide ".$menu_label." menu item", $this->plugin_name);?></span>
								</label>
								<br/>
								<?php
							endif;
						endforeach;
					?>
				</fieldset>


				<!-- Remove wp icon from admin bar -->
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e('Remove WordPress Icon from admin bar', $this->plugin_name);?></span></legend>
					<h3 class="section-subheading"><?php esc_attr_e('Remove WordPress Icon from admin bar', $this->plugin_name);?></h3>
					<label for="<?php echo $this->plugin_name;?>-remove_admin_bar_icon">
						<input type="checkbox" id="<?php echo $this->plugin_name;?>-remove_admin_bar_icon" name="<?php echo $this->plugin_name;?>[remove_admin_bar_icon]" value="1" <?php checked($remove_admin_bar_icon, 1);?>/>
						<span><?php esc_attr_e('Remove WordPress Icon', $this->plugin_name);?></span>
					</label>
				</fieldset>


				<!-- Change WordPress admin footer text -->
				<fieldset>
					<legend class="screen-reader-text"><span><?php _e('Change Admin footer text with your own', $this->plugin_name);?></span></legend>
					<h3 class="section-subheading"><?php esc_attr_e('Change Admin footer text with your own', $this->plugin_name);?></h3>
					<input type="text" class="regular-text" id="<?php echo $this->plugin_name;?>-admin_footer_text" name="<?php echo $this->plugin_name;?>[admin_footer_text]" value="<?php if(!empty($admin_footer_text)) esc_attr_e($admin_footer_text, $this->plugin_name);?>" placeholder="<?php esc_attr_e('Theme created for your awesome business', $this->plugin_name);?>" />
				</fieldset>

				<?php submit_button(__('Save Changes', $this->plugin_name), 'primary','submit', TRUE); ?>
			</div>
			<!-- End of Admin Customisations -->
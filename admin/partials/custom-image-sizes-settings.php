			<!-- Custom Image Sizes -->
			<div class="section-wrapper">
				<h2 class="section-title"><?php _e('Custom Image Sizes', $this->plugin_name);?></h2>

				<?php global $_wp_additional_image_sizes;
					$img_sizes = get_intermediate_image_sizes();
					$new_images_size_position = count($_wp_additional_image_sizes);
				?>


				<!-- Add images sizes -->
				<fieldset>
					<h3 class="section-subheading"><?php _e('Add custom image sizes for media images', $this->plugin_name);?></h3>

					<legend class="screen-reader-text"><span><?php _e('Add New Image sizes', $this->plugin_name);?></span></legend>
					<label for="<?php echo $this->plugin_name;?>-new_images_size">
						<input type="checkbox" id="<?php echo $this->plugin_name;?>-new_images_size" class="show-child-if-checked" name="<?php echo $this->plugin_name;?>[new_images_size]" value="1" <?php checked($new_images_size, 1);?>/>
						<span><?php esc_attr_e('Add New Image size', $this->plugin_name);?></span>
					</label>


					<fieldset class="new-images-size <?php if($new_images_size != '1') echo 'hidden'; ?>">
						<label for="<?php echo $this->plugin_name;?>-new_images_size_name">
							<span><?php esc_attr_e('New Images size name', $this->plugin_name);?></span>
						</label>
						<input id="<?php echo $this->plugin_name;?>-new_images_size_name" name="<?php echo $this->plugin_name;?>[images_size][name]" type="text" placeholder="ex: blog_featured">

						<br/>

						<label for="t<?php echo $this->plugin_name;?>-new_images_size_w">Width</label>
						<input name="<?php echo $this->plugin_name;?>[images_size][width]" type="number" step="1" min="0" id="<?php echo $this->plugin_name;?>-new_images_size_w" placeholder="500" class="small-text">
						<label for="<?php echo $this->plugin_name;?>-new_images_size_h">Height</label>
						<input name="<?php echo $this->plugin_name;?>[images_size][height]" type="number" step="1" min="0" id="<?php echo $this->plugin_name;?>-new_images_size_h" placeholder="300"  class="small-text">
						
						<br>

						<label for="<?php echo $this->plugin_name;?>-new_images_size_crop"><span><?php esc_attr_e('Hard-Crop images',  $this->plugin_name);?></span>
						</label>
						<input name="<?php echo $this->plugin_name;?>[images_size][crop]" type="checkbox" id="<?php echo $this->plugin_name;?>-new_images_size_crop" class="new-images-size-crop">

						<br>

						<div class="new-hard-crop-positions hidden">
							<span>Horizontal</span>
							<br>
							<fieldset>
								<legend class="screen-reader-text"><span>input type="radio"</span></legend>
								<label title='g:i a'>
								<input type="radio" name="<?php echo $this->plugin_name;?>[images_size][crop_horizontal]" value="left" id="<?php echo $this->plugin_name;?>-new_images_size_crop_left" />
								<span><?php esc_attr_e('Left',  $this->plugin_name);?></span>
								</label>
								<br>

								<label title='g:i a'>
								<input type="radio" name="<?php echo $this->plugin_name;?>[images_size][crop_horizontal]" value="center" id="<?php echo $this->plugin_name;?>-new_images_size_crop_hcenter" />
								<span><?php esc_attr_e('Center',  $this->plugin_name);?></span>
								</label>
								<br>

								<label title='g:i a'>
								<input type="radio" name="<?php echo $this->plugin_name;?>[images_size][crop_horizontal]" value="right" id="<?php echo $this->plugin_name;?>-new_images_size_crop_right" />
								<span><?php esc_attr_e('Right',  $this->plugin_name);?></span>
								</label>
							</fieldset>
							
							<br>
							<span>Vertical</span>
							<br>
							<fieldset>
								<legend class="screen-reader-text"><span>input type="radio"</span></legend>
								<label title='g:i a'>
								<input type="radio" name="<?php echo $this->plugin_name;?>[images_size][crop_vertical]" value="top" id="<?php echo $this->plugin_name;?>-new_images_size_crop_top" />
								<span><?php esc_attr_e('Top',  $this->plugin_name);?></span>
								</label>
								<br>

								<label title='g:i a'>
								<input type="radio" name="<?php echo $this->plugin_name;?>[images_size][crop_vertical]" value="center" id="<?php echo $this->plugin_name;?>-new_images_size_crop_vcenter" />
								<span><?php esc_attr_e('Center',  $this->plugin_name);?></span>
								</label>
								<br>

								<label title='g:i a'>
								<input type="radio" name="<?php echo $this->plugin_name;?>[images_size][crop_vertical]" value="bottom" id="<?php echo $this->plugin_name;?>-new_images_size_crop_bottom" />
								<span><?php esc_attr_e('Bottom',  $this->plugin_name);?></span>
								</label>
							</fieldset>
						</div>

						<?php submit_button(__('Add Image Size', $this->plugin_name), 'primary','submit', TRUE); ?>
					</fieldset>


					<fieldset class="existing-images-size-container <?php if($new_images_size_position < 2) echo 'hidden'; ?>">
						<h4 class="action-subheading"><?php _e('Current Custom Images sizes', $this->plugin_name);?></h4>
						<?php
							if(is_array($images_size_arr)):
								foreach ($images_size_arr as $existing_images_size_name => $existing_images_size_values) :?>
							
									<fieldset class="existing-images-size">
										<h4><?php echo $existing_images_size_name;?></h4>

										<label for="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_w">Width</label>
										<input name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][name]" type="hidden" value="<?php echo $existing_images_size_values['name'];?>" >
										<input name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][width]" type="number" step="1" min="0" id="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_w" value="<?php echo $existing_images_size_values['width'];?>" class="small-text" >

										<label for="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_h">Height</label>
										<input name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][height]" type="number" step="1" min="0" id="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_h" value="<?php echo $existing_images_size_values['height'];?>" class="small-text">

										<label for="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_crop">
											<span><?php esc_attr_e('Hard-Crop images',  $this->plugin_name);?></span>
										</label>
										<input name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop]" type="checkbox" id="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_crop"  class="existing-images-size-crop <?php echo $existing_images_size_values['crop']; ?>" <?php checked( is_array( $existing_images_size_values['crop'] ) );?>>


										<!-- Cropping Options -->
										<div class="existing-hard-crop-positions hidden">
											<span>Horizontal</span>
											<br>
											<fieldset>
												<legend class="screen-reader-text"><span>input type="radio"</span></legend>
												<label title='g:i a'>
												<input type="radio" name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop_horizontal]" value="left" id="<?php echo $this->plugin_name;?>-new_images_size_crop_left" <?php checked( 'left' == $existing_images_size_values['crop'][0] ); ?> />
												<span><?php esc_attr_e('Left',  $this->plugin_name);?></span>
												</label>
												<br>

												<label title='g:i a'>
												<input type="radio" name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop_horizontal]" value="center" id="<?php echo $this->plugin_name;?>-new_images_size_crop_hcenter" <?php checked( 'center' == $existing_images_size_values['crop'][0] ); ?> />
												<span><?php esc_attr_e('Center',  $this->plugin_name);?></span>
												</label>
												<br>

												<label title='g:i a'>
												<input type="radio" name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop_horizontal]" value="right" id="<?php echo $this->plugin_name;?>-new_images_size_crop_right" <?php checked( 'right' == $existing_images_size_values['crop'][0] ); ?> />
												<span><?php esc_attr_e('Right',  $this->plugin_name);?></span>
												</label>
											</fieldset>
											
											<br>
											<span>Vertical</span>
											<br>
											<fieldset>
												<legend class="screen-reader-text"><span>input type="radio"</span></legend>
												<label title='g:i a'>
												<input type="radio" name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop_vertical]" value="top" id="<?php echo $this->plugin_name;?>-new_images_size_crop_top" <?php checked( 'top' == $existing_images_size_values['crop'][1] ); ?> />
												<span><?php esc_attr_e('Top',  $this->plugin_name);?></span>
												</label>
												<br>

												<label title='g:i a'>
												<input type="radio" name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop_vertical]" value="center" id="<?php echo $this->plugin_name;?>-new_images_size_crop_vcenter" <?php checked( 'center' == $existing_images_size_values['crop'][1] ); ?> />
												<span><?php esc_attr_e('Center',  $this->plugin_name);?></span>
												</label>
												<br>

												<label title='g:i a'>
												<input type="radio" name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop_vertical]" value="bottom" id="<?php echo $this->plugin_name;?>-new_images_size_crop_bottom" <?php checked( 'bottom' == $existing_images_size_values['crop'][1] ); ?> />
												<span><?php esc_attr_e('Bottom',  $this->plugin_name);?></span>
												</label>
											</fieldset>
										</div>
										<!-- End of Cropping Options -->


										<!-- Remove Image Size -->
										<label for="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_remove">
											<span><?php esc_attr_e('Remove Image Size',  $this->plugin_name);?></span>
										</label>
										<input name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][remove]" type="checkbox" id="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_remove"  class="existing-images-size-remove <?php echo $existing_images_size_values['remove']; ?>">
										<!-- End of Remove Image Size -->

									</fieldset>

								<?php endforeach;?>
							<?php endif;?>
					</fieldset>
				</fieldset>

				<?php submit_button(__('Save Changes', $this->plugin_name), 'primary','submit', TRUE); ?>
			</div>
			<!-- End of Custom Image Sizes -->
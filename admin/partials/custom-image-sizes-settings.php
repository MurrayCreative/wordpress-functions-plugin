			<!-- Custom Image Sizes -->
			<div class="section-wrapper" id="section-images">
				<h2 class="section-title"><?php _e('Custom Image Settings', $this->plugin_name);?></h2>

				<?php global $_wp_additional_image_sizes;
					$img_sizes = get_intermediate_image_sizes();
					$new_images_size_position = count($_wp_additional_image_sizes);
				?>


				<!-- Remove default image sizes -->
				<fieldset>
					<legend class="screen-reader-text"><?php _e('Remove default image sizes', $this->plugin_name);?></legend>
					<label for="<?php echo $this->plugin_name;?>-remove_default_image_sizes">
						<input type="checkbox" id="<?php echo $this->plugin_name;?>-remove_default_image_sizes" name="<?php echo $this->plugin_name;?>[remove_default_image_sizes]" value="1" <?php checked( $remove_default_image_sizes, 1 ); ?> />
						<?php esc_attr_e( 'Remove default image sizes', $this->plugin_name ); ?>
					</label>
				</fieldset>


				<!-- Remove thumbnail dimensions -->
				<fieldset>
					<legend class="screen-reader-text"><?php _e('Remove thumbnail dimensions', $this->plugin_name);?></legend>
					<label for="<?php echo $this->plugin_name;?>-remove_thumbnail_dimensions">
						<input type="checkbox" id="<?php echo $this->plugin_name;?>-remove_thumbnail_dimensions" name="<?php echo $this->plugin_name;?>[remove_thumbnail_dimensions]" value="1" <?php checked( $remove_thumbnail_dimensions, 1 ); ?> />
						<?php esc_attr_e( 'Remove thumbnail dimensions', $this->plugin_name ); ?>
					</label>
				</fieldset>


				<!-- Custom JPEG Output Quality -->
				<fieldset>
					<legend class="screen-reader-text"><?php _e('Custom JPEG Output Quality', $this->plugin_name);?></legend>
					<label for="<?php echo $this->plugin_name;?>-custom_jpeg_quality">Custom JPEG Output Quality</label>
					<input name="<?php echo $this->plugin_name;?>[custom_jpeg_quality]" type="number" step="1" min="0" max="100" id="<?php echo $this->plugin_name;?>-custom_jpeg_quality" placeholder="80" class="small-text" value="<?php echo $custom_jpeg_quality;?>">
				</fieldset>


				<!-- Add images sizes -->
				<fieldset>
					<h3 class="section-subheading add-image-size-title"><?php _e('Add custom image sizes for media images', $this->plugin_name);?></h3>

					<fieldset class="new-images-size">
						<div class="fieldset-wrapper">
							<label for="<?php echo $this->plugin_name;?>-new_images_size_name">
								<?php esc_attr_e('New Images size name', $this->plugin_name);?>
							</label>
							<input id="<?php echo $this->plugin_name;?>-new_images_size_name" name="<?php echo $this->plugin_name;?>[images_size][name]" type="text" placeholder="ex: blog_featured">
						</div>

						<div class="fieldset-wrapper">
							<label for="t<?php echo $this->plugin_name;?>-new_images_size_w">Width</label>
							<input name="<?php echo $this->plugin_name;?>[images_size][width]" type="number" step="1" min="0" id="<?php echo $this->plugin_name;?>-new_images_size_w" placeholder="500" class="small-text">

							<label for="<?php echo $this->plugin_name;?>-new_images_size_h">Height</label>
							<input name="<?php echo $this->plugin_name;?>[images_size][height]" type="number" step="1" min="0" id="<?php echo $this->plugin_name;?>-new_images_size_h" placeholder="300" class="small-text">
						</div>
						
						<br>

						<label for="<?php echo $this->plugin_name;?>-new_images_size_crop"><?php esc_attr_e('Hard-Crop images',  $this->plugin_name);?>
						</label>
						<input name="<?php echo $this->plugin_name;?>[images_size][crop]" type="checkbox" id="<?php echo $this->plugin_name;?>-new_images_size_crop" class="new-images-size-crop">

						<br>

						<div class="new-hard-crop-positions hidden">
							<span class="crop-positions-label">Horizontal</span>
							<br>
							<fieldset class="crop-positions">
								<legend class="screen-reader-text">input type="radio"</legend>
								<label title='g:i a'>
									<input type="radio" name="<?php echo $this->plugin_name;?>[images_size][crop_horizontal]" value="left" id="<?php echo $this->plugin_name;?>-new_images_size_crop_left" />
									<?php esc_attr_e('Left',  $this->plugin_name);?>
								</label>
								<br>

								<label title='g:i a'>
									<input type="radio" name="<?php echo $this->plugin_name;?>[images_size][crop_horizontal]" value="center" id="<?php echo $this->plugin_name;?>-new_images_size_crop_hcenter" />
									<?php esc_attr_e('Center',  $this->plugin_name);?>
								</label>
								<br>

								<label title='g:i a'>
									<input type="radio" name="<?php echo $this->plugin_name;?>[images_size][crop_horizontal]" value="right" id="<?php echo $this->plugin_name;?>-new_images_size_crop_right" />
									<?php esc_attr_e('Right',  $this->plugin_name);?>
								</label>
							</fieldset>
							
							<br>
							<span class="crop-positions-label">Vertical</span>
							<br>
							<fieldset class="crop-positions">
								<legend class="screen-reader-text">input type="radio"</legend>
								<label title='g:i a'>
									<input type="radio" name="<?php echo $this->plugin_name;?>[images_size][crop_vertical]" value="top" id="<?php echo $this->plugin_name;?>-new_images_size_crop_top" />
									<?php esc_attr_e('Top',  $this->plugin_name);?>
								</label>
								<br>

								<label title='g:i a'>
									<input type="radio" name="<?php echo $this->plugin_name;?>[images_size][crop_vertical]" value="center" id="<?php echo $this->plugin_name;?>-new_images_size_crop_vcenter" />
									<?php esc_attr_e('Center',  $this->plugin_name);?>
								</label>
								<br>

								<label title='g:i a'>
									<input type="radio" name="<?php echo $this->plugin_name;?>[images_size][crop_vertical]" value="bottom" id="<?php echo $this->plugin_name;?>-new_images_size_crop_bottom" />
									<?php esc_attr_e('Bottom',  $this->plugin_name);?>
								</label>
							</fieldset>
						</div>

						<?php submit_button(__('Add Image Size', $this->plugin_name), 'primary','submit', TRUE); ?>
					</fieldset>


					<fieldset class="existing-images-size-container <?php if($new_images_size_position < 2) echo 'hidden'; ?>">
						<h4 class="action-subheading"><?php _e('Existing Custom Images sizes', $this->plugin_name);?></h4>
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
											<?php esc_attr_e('Hard-Crop images',  $this->plugin_name);?>
										</label>
										<input name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop]" type="checkbox" id="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_crop"  class="existing-images-size-crop <?php echo $existing_images_size_values['crop']; ?>" <?php checked( is_array( $existing_images_size_values['crop'] ) );?>>


										<!-- Cropping Options -->
										<div class="existing-hard-crop-positions hidden">
											<span class="crop-positions-label">Horizontal</span>
											<br>
											<fieldset class="crop-positions">
												<legend class="screen-reader-text">input type="radio"</legend>
												<label title='g:i a'>
													<input type="radio" name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop_horizontal]" value="left" id="<?php echo $this->plugin_name;?>-new_images_size_crop_left" <?php checked( 'left' == $existing_images_size_values['crop'][0] ); ?> />
													<?php esc_attr_e('Left',  $this->plugin_name);?>
												</label>
												<br>

												<label title='g:i a'>
													<input type="radio" name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop_horizontal]" value="center" id="<?php echo $this->plugin_name;?>-new_images_size_crop_hcenter" <?php checked( 'center' == $existing_images_size_values['crop'][0] ); ?> />
													<?php esc_attr_e('Center',  $this->plugin_name);?>
												</label>
												<br>

												<label title='g:i a'>
													<input type="radio" name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop_horizontal]" value="right" id="<?php echo $this->plugin_name;?>-new_images_size_crop_right" <?php checked( 'right' == $existing_images_size_values['crop'][0] ); ?> />
													<?php esc_attr_e('Right',  $this->plugin_name);?>
												</label>
											</fieldset>
											
											<br>
											<span class="crop-positions-label">Vertical</span>
											<br>
											<fieldset class="crop-positions">
												<legend class="screen-reader-text">input type="radio"</legend>
												<label title='g:i a'>
													<input type="radio" name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop_vertical]" value="top" id="<?php echo $this->plugin_name;?>-new_images_size_crop_top" <?php checked( 'top' == $existing_images_size_values['crop'][1] ); ?> />
													<?php esc_attr_e('Top',  $this->plugin_name);?>
												</label>
												<br>

												<label title='g:i a'>
													<input type="radio" name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop_vertical]" value="center" id="<?php echo $this->plugin_name;?>-new_images_size_crop_vcenter" <?php checked( 'center' == $existing_images_size_values['crop'][1] ); ?> />
													<?php esc_attr_e('Center',  $this->plugin_name);?>
												</label>
												<br>

												<label title='g:i a'>
													<input type="radio" name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][crop_vertical]" value="bottom" id="<?php echo $this->plugin_name;?>-new_images_size_crop_bottom" <?php checked( 'bottom' == $existing_images_size_values['crop'][1] ); ?> />
													<?php esc_attr_e('Bottom',  $this->plugin_name);?>
												</label>
											</fieldset>
										</div>
										<!-- End of Cropping Options -->


										<!-- Remove Image Size -->
										<div class="remove-image-size-wrapper">
											<label for="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_remove" class="bold-label">
												<?php esc_attr_e('Remove Image Size',  $this->plugin_name);?>
											</label>
											<input name="<?php echo $this->plugin_name;?>[existing_images_size][<?php echo $existing_images_size_name;?>][remove]" type="checkbox" id="<?php echo $this->plugin_name;?>-<?php echo $existing_images_size_name;?>_remove"  class="existing-images-size-remove <?php echo $existing_images_size_values['remove']; ?>">
											<!-- End of Remove Image Size -->
										</div>

									</fieldset>

								<?php endforeach;?>
							<?php endif;?>
					</fieldset>
				</fieldset>

				<?php submit_button(__('Save Changes', $this->plugin_name), 'primary','submit', TRUE); ?>
			</div>
			<!-- End of Custom Image Sizes -->
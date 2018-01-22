<div class="mkdf-two-columns-75-25 clearfix">
    <div class="mkdf-column1">
        <div class="mkdf-column-inner">
            
            
            <?php
            $media = cortex_mikado_get_portfolio_single_media();

            if(is_array($media) && count($media)) : ?>
                <div class="mkdf-portfolio-media">
                    <?php foreach($media as $single_media) : ?>
                        <div class="mkdf-portfolio-single-media">
                            <?php cortex_mikado_portfolio_get_media_html($single_media); ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
           
        </div>
    </div>
    
    <div class="mkdf-column2">
        <div class="mkdf-column-inner">
            <div class="mkdf-portfolio-info-holder">
               
                <h4 class="mkdf-portfolio-title"><?php the_field('version'); ?></h4>
                
                <p class="project-name"><?php the_field('brand'); ?></p>
                
                
                <?php if( get_field('director') ): ?>

                <div class="mkdf-portfolio-info-item mkdf-portfolio-custom-field">
                <span class="mkdf-portfolio-info-item-title">Director</span>
                <p id="director-name" class="moreinfo-name"><?php the_field('director'); ?></p>
                </div>
                <?php endif; ?>
                
                <?php if( get_field('client') ): ?>

                <div class="mkdf-portfolio-info-item mkdf-portfolio-custom-field">
                <span class="mkdf-portfolio-info-item-title">Client</span>
                <p id="client-name" class="moreinfo-name"><?php the_field('client'); ?></p>
                </div>
                <?php endif; ?>
                
                <?php if( get_field('agency') ): ?>

                <div class="mkdf-portfolio-info-item mkdf-portfolio-custom-field">
                <span class="mkdf-portfolio-info-item-title">Agency</span>
                <p id="agency-name" class="moreinfo-name"><?php the_field('agency'); ?></p>
                </div>
                
                <?php endif; ?>
                
                </div>
                
            <div class="mkdf-portfolio-content ">
            <?php the_content(); ?>
            </div>
            
            <?php
    $categories   = wp_get_post_terms(get_the_ID(), 'portfolio-category');
    $categy_names = array();

    if(is_array($categories) && count($categories)) :
        foreach($categories as $category) {
            $categy_names[] = $category->name;
        }

        ?>
        <div class="mkdf-portfolio-info-item mkdf-portfolio-categories">
            <span class="mkdf-portfolio-info-item-title"><?php echo esc_html(implode(', ', $categy_names)); ?></span>

           
        </div>
    <?php endif; ?>
            
            
            </div>
        
        </div>
    </div>


<!--RELATED PROJECTS-->
<?php 
$back_to_link = get_post_meta( get_the_ID(), 'portfolio_single_back_to_link', true );
?>
<div class="mkdf-portfolio-list-holder-outer mkdf-ptf-gallery mkdf-portfolio-slider-holder mkdf-portfolio-related-holder mkdf-ptf-hover-zoom-out-simple" data-items='5' data-centered='yes'>
    <h5 class="mkdf-ptf-related-title"><?php esc_html_e('Related Projects', 'cortex'); ?></h5>
    <div class="mkdf-portfolio-list-holder clearfix">
        <?php
        $query = cortex_mikado_get_related_post_type(get_the_ID(), array('posts_per_page' => '6'));
        if (is_object($query)) {
            if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
                <?php if (has_post_thumbnail()) {
                    $id = get_the_ID();
                    $item_link = get_permalink($id);
                    if (get_post_meta($id, 'portfolio_external_link', true) !== '') {
                        $item_link = get_post_meta($id, 'portfolio_external_link', true);
                    }

                    $categories = wp_get_post_terms($id, 'portfolio-category');
                    $category_html = '';
                    $k = 1;
                    foreach ($categories as $cat) {
                        $category_html .= '<span>' . $cat->name . '</span>';
                        if (count($categories) != $k) {
                            $category_html .= ' / ';
                        }
                        $k++;
                    }
                    ?>
                    <article class="mkdf-portfolio-item mix">
	                    <div class="mkdf-portfolio-item-inner">
	                    	<div class = "mkdf-item-image-holder">
								<a class="mkdf-portfolio-link" href="<?php echo esc_url($item_link); ?>"></a>
									<?php
										echo get_the_post_thumbnail(get_the_ID(),'cortex_mikado_square');
									?>
								<div class="mkdf-item-text-overlay">
									<div class="mkdf-item-text-overlay-inner">
										<div class="mkdf-item-text-holder">
											<h4 class="mkdf-item-title">
												<a class="mkdf-portfolio-title-link" href="<?php echo esc_url($item_link); ?>">
													<?php echo esc_attr(get_the_title()); ?>
												</a>
											</h4>
										</div>
									</div>
								</div>
							</div>
						</div>
                    </article>
                <?php } ?>
                <?php
            endwhile;
            endif;
            wp_reset_postdata();
        } else { ?>
            <p><?php esc_html_e('No related portfolios were found.', 'cortex'); ?></p>
        <?php }
        ?>
    </div>
</div>


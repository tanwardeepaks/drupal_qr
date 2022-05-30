<?php

namespace Drupal\Productqr\Plugin\Block;

use Drupal\node\Entity\Node;
use Drupal\media\Entity\Media;
use Drupal\file\Entity\File;
use Drupal\Core\Block\BlockBase;



/**
 * Provides a 'Productqr' Block.
 *
 * @Block(
 *   id = "productqr_block",
 *   admin_label = @Translation("Productqr Block"),
 *   category = @Translation("Productqr Block"),
 * )
 */
class ProductqrBlock extends BlockBase {

  /**
   * {@inheritdoc}
   */


 

  public function build() {
  
  

  
	$host = \Drupal::request()->getSchemeAndHttpHost();
	$folder_path= \Drupal::request()->getBaseUrl();
	$current_uri = \Drupal::request()->getRequestUri();
	$node_slug = end(explode('/', $current_uri));

	$file_path = $host.$folder_path."/upload/".$node_slug.'.png';
	
		
	if(!file_exists('upload')){
			mkdir('upload');
	}
	
	if( !file_exists($file_path)){
		\PHPQRCode\QRcode::png($host.$current_uri , 'upload/'.$node_slug.'.png', 'L', 4, 2);
		}
	
	

return [
      '#theme' => 'productqr_block',
        '#qrfile' => $file_path,
    ];

  }

}

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
	
	
	
	
	

	
	//$node_storage = \Drupal::entityTypeManager()->getStorage('node');
	//$node = $node_storage->load($node_slug);
	
	//$output[$i]['title'] =$node->get('title')->get(0)->get('value')->getValue();
	/*if( !file_exists('http://localhost:90/JugaadTech/upload/'.$node_slug.'.png')){
				\PHPQRCode\QRcode::png('http://localhost:90/JugaadTech/node/'.$node_slug , 'upload//'.$node_slug.'.png', 'L', 4, 2);
	}
	$file_path = 'http://localhost:90/JugaadTech/upload/'.$node_slug.'.png';
	*/

return [
      '#theme' => 'productqr_block',
        '#qrfile' => $file_path,
    ];

  }

}
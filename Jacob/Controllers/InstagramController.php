<?php
/**
 * Jakub "Jacob" Kadzielawa
 * programujemy.net
 * 03.06.17
 */

namespace Jacob\Controllers;
use Jacob\Core\Controller;
use Jacob\Helper\InstagramApi;
class InstagramController extends Controller
{
    protected $connection;
    protected $instagramObj;

    public function indexAction()
    {
           $this->view->render();
    }

    public function photosAction()
    {
    $instagram = $this->setInstagramGranted();
      
    // Get latest photos according to #hashtag keyword
    $media = $instagram->getTagMedia('boobs');

print_R($media);
exit; 
    // Set number of photos to show
    $limit = 5;

    // Set height and width for photos
    $size = '100';

    // Show results
    // Using for loop will cause error if there are less photos than the limit
    foreach(array_slice($media->data, 0, $limit) as $data)
    {
        // Show photo
        echo '<p><img src="'.$data->images->thumbnail->url.'" height="'.$size.'" width="'.$size.'" alt="SOME TEXT HERE"></p>';
    }


    }

    private function setInstagramGranted()
    {
        return InstagramApi::Instance();

    }


}

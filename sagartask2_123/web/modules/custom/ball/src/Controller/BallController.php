<?php

namespace Drupal\ball\Controller;

use Drupal\Component\Utility\Xss;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Link;
use Drupal\Core\Url;
use Drupal\ball\Entity\BallEntityInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityViewBuilder;
//use Drupal\Core\Url;



class BallController extends ControllerBase {


     public function content($id=NULL) {
        // return [
        // '#type'  => 'markup',
        // '#markup' => 'helloooo',
        // ];

         $getValue = \Drupal::routeMatch()->getParameter('id');
        //    dd($getValue);   


        $entity = \Drupal::entityTypeManager()->getStorage('ball_entity')->load($getValue);
        // dd($entity);
      

        $title =  $entity->field_title->value;
        $body = $entity->field_description->value;
        $paragraphEntity = $entity->field_card->getValue();




        $title2 = [];
        $body2 = [];
        $img = [];
        $link = [];

        foreach($paragraphEntity as $para) {
            $paragraphValue = \Drupal\paragraphs\Entity\Paragraph::load( $para['target_id'] );
         // dd($paragraphValue);
        // $arrayOfTitle[] = $paragraphValue;
         

      
         $title2[] = $paragraphValue->field_title->getString();
         $body2[] = $paragraphValue->field_description->getString();
       
         $img[] = $paragraphValue->field_image->entity->getFileUri();
       //  $link = $paragraphValue->field_link->getString();
       //  $link[]=$paragraphValue->field_link->first()->getUrl();
           $link[]= $paragraphValue->field_link->title;
            $url[]=$paragraphValue->field_link->uri;



        //  dd($link);
        }
        $lengthofarr = count($title2)-1;


        return [
            '#theme' => 'new',
            '#a' => $title,
            '#b' => $body,
            //'#c' => $paragraphEntity,
          //  'e' =>  $paragraphValue,
            '#f' => $title2,
            '#g' => $body2,
            '#h' => $img,
            '#link' => $link,
            '#uri' => $url,
            '#lengthofarr' => $lengthofarr,
        ];
       // dd($arr);

    
    }
   

   


    }






<?php

namespace Drupal\form_activity\Plugin\rest\resource;

use Drupal\rest\ModifiedResourceResponse;
use Drupal\rest\Plugin\ResourceBase;
use Drupal\rest\ResourceResponse;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Provides a resource to get view modes by entity and bundle.
 *
 * @RestResource(
 *   id = "form_activity_rest_resource",
 *   label = @Translation("Form activity rest resource"),
 *   uri_paths = {
 *     "canonical" = "/api/v1/form-activity-list"
 *   }
 * )
 */
class FormActivityRestResource extends ResourceBase {

  /**
   * A current user instance.
   *
   * @var \Drupal\Core\Session\AccountProxyInterface
   */
  protected $currentUser;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    $instance = parent::create($container, $configuration, $plugin_id, $plugin_definition);
    $instance->logger = $container->get('logger.factory')->get('form_activity');
    $instance->currentUser = $container->get('current_user');
    return $instance;
  }

    /**
     * Responds to GET requests.
     *
     * @param string $payload
     *
     * @return \Drupal\rest\ResourceResponse
     *   The HTTP response object.
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     *   Throws exception expected.
     */
    public function get($payload) {

        // You must to implement the logic of your REST Resource here.
        // Use current user after pass authentication to validate access.
        if (!$this->currentUser->hasPermission('access content')) {
            throw new AccessDeniedHttpException();
        }
        $database = \Drupal::database();
        $query = $database->query("SELECT * FROM {form_activity}");
        $result = $query->fetchAll();       
        $values=array();
        $i = 0;
        foreach($result as $row){
                foreach($row as  $key => $val){
                        $values[$i][$key]= $val;
                }
            $i++;  
        }
        //$payload = array("name"=>"Arun");
        return new ResourceResponse($values, 200);
    }

}

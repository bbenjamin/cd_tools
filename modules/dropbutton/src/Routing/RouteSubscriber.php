<?php

namespace Drupal\dropbutton\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Drupal\Core\Routing\RoutingEvents;
use Symfony\Component\Routing\RouteCollection;

/**
 * Modifies some route options.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    $routes = [
      'entity.configurable_language.collection',
      'entity.configurable_language.edit_form',
      'entity.configurable_language.delete_form',
      'entity.node_type.collection',
      'entity.node_type.edit_form',
      'entity.node_type.delete_form',
      'entity.node.field_ui_fields',
      'entity.entity_form_display.node.default',
      'entity.entity_form_display.node.form_mode',
      'entity.entity_view_display.node.default',
      'entity.entity_view_display.node.view_mode',
    ];

    foreach ($routes as $route_name) {
      if ($route = $collection->get($route_name)) {
        $route->setRequirements(['_permission' => 'access dropbutton test routes']);
      }
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function getSubscribedEvents():array {
    $events = parent::getSubscribedEvents();
    // This needs to run after user module added it's entity route.
    $events[RoutingEvents::ALTER] = ['onAlterRoutes', -176];
    return $events;
  }

}

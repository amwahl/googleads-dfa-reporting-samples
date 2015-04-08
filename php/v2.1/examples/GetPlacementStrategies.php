<?php
/*
 * Copyright 2015 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

// Require the base class.
require_once dirname(__DIR__) . "/BaseExample.php";

/**
 * This example displays all available placement strategies.
 *
 * Tags: placementStrategies.list
 *
 * @author api.jimper@gmail.com (Jonathon Imperiosi)
 */
class GetPlacementStrategies extends BaseExample {
  /**
   * (non-PHPdoc)
   * @see BaseExample::getInputParameters()
   * @return array
   */
  protected function getInputParameters() {
    return array(
        array('name' => 'user_profile_id',
              'display' => 'User Profile ID',
              'required' => true)
    );
  }

  /**
   * (non-PHPdoc)
   * @see BaseExample::run()
   */
  public function run() {
    $values = $this->formValues;

    print '<h2>Listing all placement strategies</h2>';

    $response = null;
    $page_token = null;

    $this->printResultsTableHeader('Placement Strategies');

    do {
      // Create and execute the placement strategies list request.
      $response = $this->service->placementStrategies->listPlacementStrategies(
          $values['user_profile_id'],
          array('pageToken' => $page_token)
      );

      foreach ($response->getPlacementStrategies() as $strategies) {
        $this->printResultsTableRow($strategies);
      }

      // Update the next page token.
      $next_page_token = $response->getNextPageToken();
    } while(!empty($response->getPlacementStrategies())
        && !empty($page_token));

    $this->printResultsTableFooter();
  }

  /**
   * (non-PHPdoc)
   * @see BaseExample::getName()
   * @return string
   */
  public function getName() {
    return 'Get All Placement Strategies';
  }

  /**
   * (non-PHPdoc)
   * @see BaseExample::getResultsTableHeaders()
   * @return array
   */
  public function getResultsTableHeaders() {
    return array(
        'id' => 'Placement Strategy ID',
        'name' => 'Placement Strategy Name'
    );
  }
}

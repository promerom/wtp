<?php
namespace AppBundle\Model;
/**
 * @package   fisharebest/algorithm
 * @author    Greg Roach <greg@subaqua.co.uk>
 * @copyright (c) 2015 Greg Roach <greg@subaqua.co.uk>
 * @license   GPL-3.0+
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */
/**
 * Class Dijkstra - Use Dijkstra's algorithm to calculate the shortest path
 * through a weighted, directed graph.
 */
class WorldTravellerProblem {
	
	protected $roads;

	public function __construct($roads) {
		$this->roads = $roads;
	}
	
	public function wtp() {

		$roads = $this->roads;

		$accPath[0]["cost"] = $roads[0][0];
		$accPath[0]["points"][0] = $roads[0][1];
		$accPath[0]["points"][1] = $roads[0][2];

		$j=1;
		for ($i=1; $i<count($roads); $i++) {
			$value = $roads[$i];
			$cost = $value[0];
			$city1 = $value[1];
			$city2 = $value[2];

			if (!$this->searchCity1($city2, $accPath) && !$this->searchCity1($city1, $accPath)) {
				$accPath[$j]["cost"] = $cost;
				$accPath[$j]["points"][0] = $city1;
				$accPath[$j]["points"][1] = $city2;
				$j++;
			}
		}

		$road["road"][0] = $accPath[0]["points"][0];
		$road["road"][1] = $accPath[0]["points"][1];

		for ($x = 1; $x < count($accPath); $x++) {
			if ($road["road"][$x] == $accPath[$x]["points"][0]) {
				$road["road"][$x+1] = $accPath[$x]["points"][1];
			} else {
				$road["road"][$x+1] = $accPath[$x]["points"][0];
			}
		}

		$road["cost"] = $this->accCost($accPath);
		return $road;
	}

	public function searchCity($id, $array) {

		foreach ($array as $key => $val) {
			if ($val['points'][0] === $id || $val['points'][1] === $id) {
				return true;
			}
		}
		return null;
	}

	public function searchCity1($id, $array) {

		foreach ($array as $key => $val) {
			if ($val['points'][0] === $id) {
				return true;
			}
		}
		return null;
	}

	public function accCost($result) {
		$cost = 0;
		foreach ($result as $key => $value) {
			$cost += $value["cost"];
		}
		return $cost;
	}
}
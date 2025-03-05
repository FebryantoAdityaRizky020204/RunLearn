<?php
// Graph data (distance between cities)
$graph = [
    "Oslo" => ["Helsinki" => 970, "Stockholm" => 570],
    "Helsinki" => ["Oslo" => 970, "Stockholm" => 400],
    "Stockholm" => ["Oslo" => 570, "Helsinki" => 400, "Copenhagen" => 522],
    "Copenhagen" => ["Stockholm" => 522, "Warsaw" => 668],
    "Warsaw" => ["Copenhagen" => 668, "Bucharest" => 946],
    "Bucharest" => ["Warsaw" => 946, "Athens" => 1300, "Budapest" => 900],
    "Budapest" => ["Bucharest" => 900, "Belgrade" => 316, "Prague" => 443, "Milan" => 789, "Vienna" => 217],
    "Belgrade" => ["Budapest" => 316, "Sofia" => 330],
    "Rome" => ["Palermo" => 1043, "Milan" => 681, "Barcelona" => 1471],
    "Palermo" => ["Rome" => 1043, "Athens" => 907],
    "Milan" => ["Rome" => 681, "Budapest" => 789],
    "Prague" => ["Budapest" => 443, "Berlin" => 354, "Vienna" => 312],
    "Berlin" => ["Prague" => 354, "Copenhagen" => 743, "Amsterdam" => 648],
    "Munich" => ["Lyon" => 753, "Vienna" => 458],
    "Vienna" => ["Budapest" => 217, "Prague" => 312, "Munich" => 458],
    "Lyon" => ["Munich" => 753, "Paris" => 481, "Bordeaux" => 542],
    "Madrid" => ["Barcelona" => 628, "Lisbon" => 638],
    "Lisbon" => ["Madrid" => 638, "London" => 2210],
    "Barcelona" => ["Madrid" => 628, "Lyon" => 644, "Rome" => 1471],
    "Paris" => ["Lyon" => 481, "Bordeaux" => 579, "London" => 414],
    "London" => ["Paris" => 414, "Dublin" => 463, "Glasgow" => 667],
    "Glasgow" => ["London" => 667, "Amsterdam" => 711, "Dublin" => 306],
    "Dublin" => ["London" => 463, "Glasgow" => 306],
    "Amsterdam" => ["Berlin" => 648, "Glasgow" => 711]
];

// Estimated straight-line distances to Bucharest
$heuristic = [
    "Amsterdam" => 2280, "Lyon" => 1660, "Athens" => 1300, "Madrid" => 3300,
    "Barcelona" => 2670, "Milan" => 1750, "Belgrade" => 630, "Munich" => 1600,
    "Berlin" => 1800, "Oslo" => 2870, "Bordeaux" => 2100, "Palermo" => 1280,
    "Budapest" => 900, "Paris" => 2970, "Copenhagen" => 2250, "Prague" => 1490,
    "Dublin" => 2530, "Rome" => 1140, "Glasgow" => 2470, "Sofia" => 390,
    "Helsinki" => 2820, "Stockholm" => 2890, "Lisbon" => 3950, "London" => 2590,
    "Warsaw" => 946, "Bucharest" => 0, "Vienna" => 1150
];

function a_star($start, $goal, $graph, $heuristic) {
    $openSet = [$start];
    $cameFrom = [];
    $gScore = [$start => 0];
    $fScore = [$start => $heuristic[$start]];

    while (!empty($openSet)) {
        $current = null;
        $lowestF = PHP_INT_MAX;
        foreach ($openSet as $node) {
            if (isset($fScore[$node]) && $fScore[$node] < $lowestF) {
                $lowestF = $fScore[$node];
                $current = $node;
            }
        }
        if ($current === null) {
            return [];
        }

        if ($current == $goal) {
            return reconstruct_path($cameFrom, $current);
        }

        $openSet = array_diff($openSet, [$current]);

        if (!isset($graph[$current])) {
            continue;
        }

        foreach ($graph[$current] as $neighbor => $distance) {
            $tentative_gScore = $gScore[$current] + $distance;

            if (!isset($gScore[$neighbor]) || $tentative_gScore < $gScore[$neighbor]) {
                $cameFrom[$neighbor] = $current;
                $gScore[$neighbor] = $tentative_gScore;
                $fScore[$neighbor] = $gScore[$neighbor] + $heuristic[$neighbor];
                if (!in_array($neighbor, $openSet)) {
                    $openSet[] = $neighbor;
                }
            }
        }
    }
    return [];
}

function reconstruct_path($cameFrom, $current) {
    $total_path = [$current];
    while (isset($cameFrom[$current])) {
        $current = $cameFrom[$current];
        array_unshift($total_path, $current);
    }
    return $total_path;
}

$path = a_star("Lisbon", "Bucharest", $graph, $heuristic);

// Print table
echo "<table border='1'>";
echo "<tr><th>Current City</th><th>Neighboring Cities</th><th>g(n)</th><th>h(n)</th><th>f(n)</th><th>Decision Made</th></tr>";

$g = 0;
foreach ($path as $index => $city) {
    $neighbors = isset($graph[$city]) ? implode(", ", array_keys($graph[$city])) : "-";
    $h = isset($heuristic[$city]) ? $heuristic[$city] : PHP_INT_MAX;
    $f = $g + $h;
    echo "<tr><td>$city</td><td>$neighbors</td><td>$g</td><td>$h</td><td>$f</td><td>Move to $city</td></tr>";
    if ($index < count($path) - 1 && isset($graph[$city][$path[$index + 1]])) {
        $g += $graph[$city][$path[$index + 1]];
    }
}

echo "</table>";
?>
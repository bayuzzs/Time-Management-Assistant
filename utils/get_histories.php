<?php
require_once 'mysqli.php';
require_once 'auth.php';
session_start();

// if doesn't have cookie
if (!isset($_COOKIE["auth_user"], $_COOKIE["auth_token"])) {
  echo json_encode(['error' => 'no cookie']);
  die();
}

$userId = $_COOKIE["auth_user"];
// if user cookie invalid
if (!checkAuthCookie($_COOKIE["auth_user"], $_COOKIE["auth_token"])) {
  echo json_encode(['error' => 'Invalid cookie']);
  die();
}

$filter = $_GET['filter'];
$userId = $_COOKIE["auth_user"];
switch ($filter) {
  case 'week':
    $query = "SELECT DAYNAME(date) as day, count(*) as total FROM history_activities WHERE id_user = ? AND YEARWEEK(date) = YEARWEEK(CURDATE()) GROUP BY day";
    $label = "Activities in Day";
    $labels = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    break;
  case 'month':
    $query = "SELECT CONCAT('Week - ', WEEKOFYEAR(date) - WEEKOFYEAR(date - INTERVAL DAY(date) - 1 DAY) + 1) AS week_number, count(*) AS total FROM history_activities WHERE id_user = ? AND YEAR(date) = YEAR(CURDATE()) AND MONTH(date) = MONTH(CURDATE()) GROUP BY WEEKOFYEAR(date)";
    $label = "Activities in Week";
    $labels = ["Week - 1", "Week - 2", "Week - 3", "Week - 4", "Week - 5"];
    break;
  case 'year':
    $query = "SELECT MONTHNAME(date) as month, count(*) as total FROM history_activities WHERE id_user = ? AND YEAR(date) = YEAR(CURDATE()) GROUP BY MONTH(date)";
    $label = "Activities in Month";
    $labels = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    break;
}

// Prepare the statement
$stmt = $mysqli->prepare($query);
if (!$stmt) {
  echo json_encode(['error' => 'Failed to prepare statement']);
  die();
}

// Bind the parameter
$stmt->bind_param("s", $userId);

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Check if the query returned any rows
if ($result->num_rows === 0) {
  $data = [
    "labels" => $labels,
    "datasets" => [
      [
        "label" => $label,
        "data" => [],
        "backgroundColor" => "#acdaff",
        "borderColor" => "#0091ff",
        "borderWidth" => 2
      ]
    ]
  ];
  $options = [
    "scales" => [
      "y" => [
        "beginAtZero" => true,
        "max" => 10,
        "stepSize" => 2
      ]
    ],
    "responsive" => true
  ];
  $result = [
    "data" => $data,
    "options" => $options
  ];
  echo json_encode($result);
  die();
}

$result = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
// data for chartjs
$data = [
  "labels" => [],
  "datasets" => [
    [
      "label" => $label,
      "data" => [],
      "backgroundColor" => "#acdaff",
      "borderColor" => "#0091ff",
      "borderWidth" => 2
    ]
  ]
];
// die(var_dump($result));
// initial max value
$max = 0;
// looping to fill data
foreach ($labels as $key => $label) {
  array_push($data["labels"], $label);

  // if data-i has value
  if (isset($result[$key])) {
    $resultKey = array_keys($result[0]);
    if ($result[$key][$resultKey[0]] != $label) {
      array_splice($result, $key, 0, [[$resultKey[0] => $label, 'total' => 0]]);
    }
    array_push($data["datasets"][0]["data"], $result[$key]["total"]);

    // set the highest value in y axis chart
    if ($result[$key]["total"] > $max) {
      $max = $result[$key]["total"];
    }
  } else {
    // if data-i doesn't have value, add new with value 0
    array_push($result, [
      array_keys($result[0])[0] => $labels[$key],
      "total" => 0
    ]);
    array_push($data["datasets"][0]["data"], $result[$key]["total"]);

    // set the highest value in y axis chart
    if ($result[$key]["total"] > $max) {
      $max = $result[$key]["total"];
    }
  }
}

$options = [
  "scales" => [
    "y" => [
      "beginAtZero" => true,
      "max" => round($max + 10, -1, PHP_ROUND_HALF_DOWN),
      "stepSize" => round($max + 10, -1, PHP_ROUND_HALF_DOWN) / 2
    ]
  ],
  "responsive" => true
];

$result = [
  "data" => $data,
  "options" => $options
];
// die(var_dump($result, $result["data"]["datasets"][0]["data"]));
echo json_encode($result);
?>
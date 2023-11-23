<?php
// Ambil activity
$stmt = $mysqli->prepare("SELECT * FROM activities WHERE id_user = ?");
$stmt->bind_param("s", $id_user);
$stmt->execute();
$activities = $stmt->get_result();
$stmt->close();
?>
<?php if (!($activities->num_rows)): ?>
  <!-- empty activity -->
  <div class="activity__content__empty">
    <img src="./assets/images/dashboard/empty.png">
    <p>No activities yet</p>
  </div>
<?php endif; ?>
<?php while ($activitiy = $activities->fetch_assoc()) {
  [
    'title' => $title,
    'description' => $description,
    'date' => $date,
    'time' => $time,
    'priority' => $priority,
    'repetition' => $repetition
  ] = $activitiy;
  renderActivity($title, $description, $date, $time, $priority, $repetition);
} ?>
<div class="row">
  <div class="col-md-12 col-lg-12 order-md-last">
    <h4 class="d-flex justify-content-between align-items-center mb-3">
      <span class="text-primary">Logs</span>
      <span class="badge bg-primary rounded-pill"><?php echo sizeof($logs) ?></span>
    </h4>
    <table class="table table-bordered table-striped table-hover table-sm">
      <thead>
        <tr class="table-primary">
          <th>#</th>
          <th>Context</th>
          <th>Timestamp</th>
          <th>Message</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($logs as $index => $log) : ?>
          <tr>
            <td><?php echo htmlspecialchars($log[0]); ?></td>
            <td><?php echo htmlspecialchars($log[1]); ?></td>
            <td><?php echo htmlspecialchars($log[2]); ?></td>
            <td><?php echo htmlspecialchars($log[3]); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>

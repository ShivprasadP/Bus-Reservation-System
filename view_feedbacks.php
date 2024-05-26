<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Feedback</title>
    <style>
        .container {
            background-color: rgba(147, 129, 255, 0.2);
            padding: 50px;
            border-radius: 30px;
        }
        .table-bordered td, .table-bordered th {
            border: 2px solid black !important;
        }
    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="d-flex flex-column">
        <div class="row">
            <div class="col-12">
                <div class="mb-4">
                    <?php include 'get_feedback.php'; ?>
                    <form method="post" action="view_feedbacks.php">
                        <label for="feedbackType">Choose Feedback Type:</label>
                        <div class="row">
                            <div class="col-md-7 mx-auto">
                                <div class="input-group">
                                    <select class="form-control" id="feedbackType" name="feedbackType">
                                        <option value="select">Select Option</option>
                                        <option value="busFeedback">Bus Feedback</option>
                                        <option value="driverFeedback">Driver Feedback</option>
                                        <option value="conductorFeedback">Conductor Feedback</option>
                                    </select>
                                    <div class="input-group-append ml-4">
                                        <button class="btn btn-primary" type="submit">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="container">
                    <div class="d-flex justify-content-between align-items-center">
                        <h2>
                            <?php 
                                if ($feedbackType == 'busFeedback') {
                                    echo "Bus Feedback";
                                } elseif ($feedbackType == 'driverFeedback') {
                                    echo "Driver Feedback";
                                } elseif ($feedbackType == 'conductorFeedback') {
                                    echo "Conductor Feedback";
                                } else {
                                    echo "Feedback";
                                }
                            ?>
                        </h2>
                    </div>
                    <table class="table mt-4 table-bordered" id="feedbackTable">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Bus Number</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Zip</th>
                                <th>Comments</th>
                            </tr>
                        </thead>
                        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
                            <?php if ($_POST['feedbackType'] == 'select'): ?>
                                <tbody>
                                    <tr>
                                        <td colspan="7" class="text-center">Please select the feedback type</td>
                                    </tr>
                                </tbody>
                            <?php elseif (empty($feedbacks)): ?>
                                <tbody>
                                    <tr>
                                        <td colspan="7" class="text-center">No results found</td>
                                    </tr>
                                </tbody>
                            <?php else: ?>
                                <?php foreach ($feedbacks as $feedback): ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $feedback['bus_num']; ?></td>
                                            <td><?php echo $feedback['city']; ?></td>
                                            <td><?php echo $feedback['state']; ?></td>
                                            <td><?php echo $feedback['zip']; ?></td>
                                            <td><?php echo $feedback['comments']; ?></td>
                                            <td><?php echo $feedback['date']; ?></td>
                                            <td><?php echo $feedback['time']; ?></td>
                                        </tr>
                                    </tbody>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
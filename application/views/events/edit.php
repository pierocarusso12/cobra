<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Event</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/min/moment.min.js"></script>
</head>
<body>
    <h1>Edit Event</h1>
    <?php echo validation_errors(); ?>
    <?php echo form_open('events/edit/'.$event['id']); ?>

    <label for="title">Title:</label>
    <input type="text" name="title" value="<?php echo set_value('title', $event['title']); ?>" /><br/>

    <label for="description">Description:</label>
    <textarea name="description"><?php echo set_value('description', $event['description']); ?></textarea><br/>

    <label for="start_datetime">Start Date:</label>
    <input type="datetime-local" name="start_datetime" value="<?php echo set_value('start_datetime', date('Y-m-d\TH:i', strtotime($event['start_datetime']))); ?>" /><br/>

    <label for="end_datetime">End Date:</label>
    <input type="datetime-local" name="end_datetime" value="<?php echo set_value('end_datetime', date('Y-m-d\TH:i', strtotime($event['end_datetime']))); ?>" /><br/>

    <input type="submit" name="submit" value="Update Event" />

    </form>
</body>
</html>

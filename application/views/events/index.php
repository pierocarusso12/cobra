<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Eventos</title>
    <script>
    var baseUrl = '<?php echo base_url(); ?>';
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/style.css'); ?>">
<script src="<?php echo base_url('assets/js/events.js'); ?>"></script>

</head>
<body>
    <h1>Registro de Eventos Cobra</h1>
    
    <h2>Agregar un nuevo Evento</h2>
    <form id="addEventForm">
        <input type="text" name="title" placeholder="Título" required>
        <textarea name="description" placeholder="Descripción"></textarea>
        <input type="datetime-local" name="start_datetime" required>
        <input type="datetime-local" name="end_datetime" required>
        <button type="submit">Agregar Evento</button>
    </form>

    <h2>Lista de Eventos</h2>
    <table>
        <thead>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Hora de Inicio</th>
                <th>Hora de Fin</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="eventsList">
    <?php if(isset($events) && is_array($events) && count($events) > 0): ?>
        <?php foreach ($events as $event): ?>
            <tr>
                <td><?php echo $event['title']; ?></td>
                <td><?php echo $event['description']; ?></td>
                <td><?php echo $event['start_datetime']; ?></td>
                <td><?php echo $event['end_datetime']; ?></td>
                <td>
                    <button class="editEvent" data-id="<?php echo $event['id']; ?>">Editar</button>
                    <button class="deleteEvent" data-id="<?php echo $event['id']; ?>">Eliminar</button>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="5">No hay eventos para mostrar.</td>
        </tr>
    <?php endif; ?>
</tbody>
<div id="pagination"></div>
    </table>

    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Editar Evento</h2>
            <form id="editEventForm">
                <input type="hidden" name="id" id="editEventId">
                <input type="text" name="title" id="editEventTitle" required>
                <textarea name="description" id="editEventDescription"></textarea>
                <input type="datetime-local" name="start_datetime" id="editEventStart" required>
                <input type="datetime-local" name="end_datetime" id="editEventEnd" required>
                <button type="submit">Actualizar Evento</button>
            </form>
        </div>
    </div>
</body>
</html>
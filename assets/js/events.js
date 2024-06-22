$(document).ready(function() {
    // Cargar eventos al iniciar la página
    loadEvents();

    // Manejar el envío del formulario para agregar eventos
    $('#addEventForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        
        $.ajax({
            type: 'POST',
            url: baseUrl + 'index.php/events/add',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#addEventForm')[0].reset(); // Limpiar el formulario
                    loadEvents(); // Recargar la lista de eventos
                } else {
                    alert('Error al agregar el evento: ' + response.errors);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Error al agregar el evento');
            }
        });
    });
    

    // Función para cargar eventos
    function loadEvents() {
        $.ajax({
            type: 'GET',
            url: baseUrl + 'index.php/events/getAll',
            dataType: 'json',
            success: function(events) {
                displayEvents(events);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Error al cargar los eventos');
            }
        });
    }

    // Función para mostrar eventos en la tabla
    function displayEvents(events) {
        var eventsHtml = '';
        $.each(events, function(index, event) {
            eventsHtml += '<tr>' +
                '<td>' + event.title + '</td>' +
                '<td>' + event.description + '</td>' +
                '<td>' + event.start_datetime + '</td>' +
                '<td>' + event.end_datetime + '</td>' +
                '<td>' +
                    '<button class="editEvent" data-id="' + event.id + '">Editar</button>' +
                    '<button class="deleteEvent" data-id="' + event.id + '">Eliminar</button>' +
                '</td>' +
                '</tr>';
        });
        $('#eventsList').html(eventsHtml);
    }

    // Manejar la edición de eventos
    $(document).on('click', '.editEvent', function() {
        var eventId = $(this).data('id');
        // Cargar los datos del evento para edición
        $.ajax({
            type: 'GET',
            url: baseUrl + 'index.php/events/getOne/' + eventId,
            dataType: 'json',
            success: function(event) {
                // Llenar el formulario de edición con los datos del evento
                $('#editEventForm input[name="id"]').val(event.id);
                $('#editEventForm input[name="title"]').val(event.title);
                $('#editEventForm textarea[name="description"]').val(event.description);
                $('#editEventForm input[name="start_datetime"]').val(formatDateTime(event.start_datetime));
                $('#editEventForm input[name="end_datetime"]').val(formatDateTime(event.end_datetime));
                
                // Abrir el modal
                $('#editModal').show();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Error al cargar el evento para edición');
            }
        });
    });
    
    // Función para formatear la fecha y hora
    function formatDateTime(dateTimeString) {
        var date = new Date(dateTimeString);
        return date.getFullYear() + '-' + 
               ('0' + (date.getMonth() + 1)).slice(-2) + '-' + 
               ('0' + date.getDate()).slice(-2) + 'T' + 
               ('0' + date.getHours()).slice(-2) + ':' + 
               ('0' + date.getMinutes()).slice(-2);
    }
    
    // Cerrar el modal
    $('.close').click(function() {
        $('#editModal').hide();
    });
    
    $('#editEventForm').submit(function(event) {
        event.preventDefault();
        var formData = $(this).serialize();
        
        $.ajax({
            type: 'POST',
            url: baseUrl + 'index.php/events/edit',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    $('#editModal').hide(); // Ocultar el modal de edición
                    loadEvents(); // Recargar la lista de eventos
                } else {
                    alert('Error al editar el evento: ' + response.errors);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Error al editar el evento');
            }
        });
    });
    

    // Manejar la eliminación de eventos
    $(document).on('click', '.deleteEvent', function() {
        var eventId = $(this).data('id');
        if (confirm('¿Estás seguro de que quieres eliminar este evento?')) {
            $.ajax({
                type: 'POST',
                url: baseUrl + 'index.php/events/delete',
            data: { id: eventId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    loadEvents(); // Recargar la lista de eventos
                } else {
                    alert('Error al eliminar el evento');
                }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert('Error al eliminar el evento');
                }
            });
        }
    });
});

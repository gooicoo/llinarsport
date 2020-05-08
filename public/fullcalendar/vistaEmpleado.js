document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendario = new FullCalendar.Calendar(calendarEl, {
        plugins: [ 'dayGrid' , 'interaction' , 'timeGrid' , 'list'],

        header:{
          left:'prev,next today Miboton',
          center:'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay',
        },

        events: "calendario/show",
    });

    calendario.setOption('locale','Es');
    calendario.render();


});

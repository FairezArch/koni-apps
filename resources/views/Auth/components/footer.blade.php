<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js" integrity="sha256-XOMgUu4lWKSn8CFoJoBoGd9Q/OET+xrfGYSo+AKpFhE=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/locales-all.min.js" integrity="sha256-GcByKJnun2NoPMzoBsuCb4O2MKiqJZLlHTw3PJeqSkI=" crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            initialDate: '2021-11-07',
            headerToolbar: {
                left: 'dayGridMonth,timeGridWeek,timeGridDay,title',
                right: 'prev,next',
            },
            events: [{
                    title: 'All Day Event',
                    start: '2021-11-01'
                },
                {
                    title: 'Long Event',
                    start: '2021-11-07',
                    end: '2021-11-10'
                },
                {
                    groupId: '999',
                    title: 'Repeating Event',
                    start: '2021-11-09T16:00:00'
                },
                {
                    groupId: '999',
                    title: 'Repeating Event',
                    start: '2021-11-16T16:00:00'
                },
                {
                    title: 'Conference',
                    start: '2021-11-11',
                    end: '2021-11-13'
                },
                {
                    title: 'Meeting',
                    start: '2021-11-12T10:30:00',
                    end: '2021-11-12T12:30:00'
                },
                {
                    title: 'Lunch',
                    start: '2021-11-12T12:00:00'
                },
                {
                    title: 'Meeting',
                    start: '2021-11-12T14:30:00'
                },
                {
                    title: 'Birthday Party',
                    start: '2021-11-13T07:00:00'
                },
                {
                    title: 'Click for Google',
                    url: 'http://google.com/',
                    start: '2021-11-28'
                }
            ]
        });

        calendar.render();
    });
</script>
</body>

</html>
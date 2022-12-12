<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Hope UI | Responsive Bootstrap 5 Admin Dashboard Template</title>
      <link rel="shortcut icon" href="<?= base_url() ?>/assets/images/favicon.ico" />
      <link rel="stylesheet" href="<?= base_url() ?>/assets/css/core/libs.min.css" />
      <link rel="stylesheet" href="<?= base_url() ?>/assets/vendor/aos/dist/aos.css" />
      <link rel="stylesheet" href="<?= base_url() ?>/assets/css/hope-ui.min.css?v=1.2.0" />
      <link rel="stylesheet" href="<?= base_url() ?>/assets/css/custom.min.css?v=1.2.0" />
      <link rel="stylesheet" href="<?= base_url() ?>/assets/css/dark.min.css"/>
      <link rel="stylesheet" href="<?= base_url() ?>/assets/css/customizer.min.css" />
      <link rel="stylesheet" href="<?= base_url() ?>/assets/css/rtl.min.css"/>
      <link rel="stylesheet" href="<?= base_url() ?>/assets/fullcalendar/fullcalendar.min.css" />
      <link rel='stylesheet' href='<?= base_url() ?>/assets/assets/vendor/fullcalendar/core/main.css' />
      <link rel='stylesheet' href='<?= base_url() ?>/assets/assets/vendor/fullcalendar/daygrid/main.css' />
      <link rel='stylesheet' href='<?= base_url() ?>/assets/assets/vendor/fullcalendar/timegrid/main.css' />
      <link rel='stylesheet' href='<?= base_url() ?>/assets/assets/vendor/fullcalendar/list/main.css' />
      <link rel="stylesheet" href="<?=base_url()?>/assets/fullcalendar/fullcalendar.min.css" />
      <script src="<?=base_url()?>/assets/fullcalendar/lib/jquery.min.js"></script>
      <script src="<?=base_url()?>/assets/fullcalendar/lib/moment.min.js"></script>
      <script src="<?=base_url()?>/assets/fullcalendar/fullcalendar.min.js"></script>

<script>

$(document).ready(function () {
    var calendar = $('#calendar').fullCalendar({
        editable: true,
        events: "fetch-event.php",
        displayEventTime: false,
        eventRender: function (event, element, view) {
            if (event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },
        selectable: true,
        selectHelper: true,
        select: function (start, end, allDay) {
            var title = prompt('Event Title:');

            if (title) {
                var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
                var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");

                $.ajax({
                    url: 'add-event.php',
                    data: 'title=' + title + '&start=' + start + '&end=' + end,
                    type: "POST",
                    success: function (data) {
                        displayMessage("Added Successfully");
                    }
                });
                calendar.fullCalendar('renderEvent',
                        {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                true
                        );
            }
            calendar.fullCalendar('unselect');
        },

        editable: true,
        eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
                    $.ajax({
                        url: 'edit-event.php',
                        data: 'title=' + event.title + '&start=' + start + '&end=' + end + '&id=' + event.id,
                        type: "POST",
                        success: function (response) {
                            displayMessage("Updated Successfully");
                        }
                    });
                },
        eventClick: function (event) {
            var deleteMsg = confirm("Do you really want to delete?");
            if (deleteMsg) {
                $.ajax({
                    type: "POST",
                    url: "delete-event.php",
                    data: "&id=" + event.id,
                    success: function (response) {
                        if(parseInt(response) > 0) {
                            $('#calendar').fullCalendar('removeEvents', event.id);
                            displayMessage("Deleted Successfully");
                        }
                    }
                });
            }
        }

    });
});

function displayMessage(message) {
	    $(".response").html("<div class='success'>"+message+"</div>");
    setInterval(function() { $(".success").fadeOut(); }, 1000);
}
</script>

<style>
body {
    margin-top: 50px;
    text-align: center;
    font-size: 12px;
    font-family: "Lucida Grande", Helvetica, Arial, Verdana, sans-serif;
}

#calendar {
    width: 700px;
    margin: 0 auto;
}

.response {
    height: 60px;
}

.success {
    background: #cdf3cd;
    padding: 10px 60px;
    border: #c3e6c3 1px solid;
    display: inline-block;
}
</style>
</head>
<body>
    <h2>PHP Calendar Event Management FullCalendar JavaScript Library</h2>

    <div class="response"></div>
    <div id='calendar'></div>
</body>



<script src="<?=base_url()?>/assets/js/core/external.min.js"></script>
<script src="<?=base_url()?>/assets/js/charts/widgetcharts.js"></script>
<script src="<?=base_url()?>/assets/js/charts/vectore-chart.js"></script>
<script src="<?=base_url()?>/assets/js/charts/dashboard.js" ></script>
<script src="<?=base_url()?>/assets/js/plugins/fslightbox.js"></script>
<script src="<?=base_url()?>/assets/js/plugins/setting.js"></script>
<script src="<?=base_url()?>/assets/js/plugins/slider-tabs.js"></script>
<script src="<?=base_url()?>/assets/js/plugins/form-wizard.js"></script>
<script src="<?=base_url()?>/assets/js/hope-ui.js" defer></script>
<script src="<?=base_url()?>/assets/js/plugins/prism.mini.js"></script>
<script src="<?=base_url()?>/assets/vendor/aos/dist/aos.js"></script>


<script src="<?=base_url()?>/assets/assets/vendor/fullcalendar/core/main.js"></script>
<script src="<?=base_url()?>/assets/assets/vendor/fullcalendar/daygrid/main.js"></script>
<script src="<?=base_url()?>/assets/assets/vendor/fullcalendar/timegrid/main.js"></script>
<script src="<?=base_url()?>/assets/assets/vendor/fullcalendar/list/main.js"></script>
<script src="<?=base_url()?>/assets/assets/vendor/fullcalendar/interaction/main.js"></script>

<script src="<?=base_url()?>/assets/assets/vendor/moment.min.js"></script>
<script src="<?=base_url()?>/assets/assets/js/plugins/calender.js"></script>
</body>
</html>

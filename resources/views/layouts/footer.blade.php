<script src="/bootstrap-5.3.2-dist/js/bootstrap.js"></script>
<script src={{url('https://code.jquery.com/jquery-3.6.0.min.js')}}></script>
<script src={{url('https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js')}}></script>
<script src={{url('https://js.pusher.com/8.2.0/pusher.min.js')}}></script>
  <script>

    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('e972c3b0e0031d8238fe', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      $.ajax({
        type:'GET',
        url: '/osaemp/updateunseenmessage',
        data: {
        }
        success: function(data){
        console.log(data.unseenCounter);
        $('.pending-div').empty();
          html = ``;
          if(data.unseenCounter >0){
            html += `<span style="right:68px;" class="pending-notification-chat">`${data.unseenCounter}
          }
          $('.pending-div').html(html);
        }
      });
    });
  </script>
</body>
</html>

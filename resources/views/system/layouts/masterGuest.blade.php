<!DOCTYPE html>
<html lang="en">

<head>
  <title>{{translate($title ?? 'Raptor V5 Base')}}</title>
    @include('system.layouts.layoutHeader')

</head>

<body style="background-color: rgba(41, 41, 97, 0.09);">

  <style>
    html,
    body {
      height: 100%;
    }
  </style>
  @yield('content')
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script>
    function hex2rgb(hex, opacity) {
        var h=hex.replace('#', '');
        h =  h.match(new RegExp('(.{'+h.length/3+'})', 'g'));

        for(var i=0; i<h.length; i++)
            h[i] = parseInt(h[i].length==1? h[i]+h[i]:h[i], 16);

        if (typeof opacity != 'undefined')  h.push(opacity);

        return 'rgba('+h.join(',')+')';
    }
    $(function() {
        $("body").css("background-color", hex2rgb("{{getCmsConfig('cms theme color')}}", 0.09));
    })
</script>
</body>

</html>


      function obtenerminiatura() {
      var url=document.getElementById('texturl').value;
	  var meter=document.getElementById('imagen');
	  var video, results, thumburl;
      results = url.match('[\\?&]v=([^&#]*)');
      video   = (results === null) ? url : results[1];
      thumburl = 'http://img.youtube.com/vi/'+video+ '/'+'0.jpg';
      meter.setAttribute("src", thumburl);}
 
<!doctype html>
<html lang="en">
  <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
     <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.0/dist/chart.min.js"></script>
    </head>
  <body>
       <h1></h1>
    </div>
 <div class="container ">

 </div>
 <div class="container p-3 my-3 bg-primary text-white">
     <h1>62111760 Areeya Chanakan</h1>
    </div>
      <div class="row">
        <div class="col-6">
          <canvas id="myChart" width="400" height="200"></canvas>
        </div>
      <div class="row">
        <div class="col-6">
          <canvas id="ChartMy" width="400" height="200"></canvas>
        </div>
      </div>
      </div>
      <div class="row">
        <div class="col-4">
          <div class="row">
              <div class="col-4">
                <b>Temperature</b>
              </div>
               <div class="col-8">
                  <b><span id="lastTempearature"></span></b>
               </div> 
          </div>
          <div class="row">
            <div class="col-4">
              <b>Humadity</b>
            </div>
             <div class="col-8">
                <b><span id="lastHumadity"></span></b>
             </div> 
        </div>
        <div class="row">
          <div class="col-4">
            <b>Update</b>  
          </div>
           <div class="col-8">
          <b><span id="lastUpdate"></span></b> 
           </div> 
      </div>

      </div>
  </div>
    
  </body>
  <script>
     function showChart(data,xlabel,id,label){      
        var ctx = document.getElementById(id).getContext('2d');
        var myChart = new Chart (ctx, {
            type: 'line',
            data: {
                labels: xlabel,
                datasets: [{
                    label: label,
                    data: data,
                }]
            }
    
        });
      }
      
      function loaddata(xlabel,dataH,dataT,url)
      {
        $.getJSON(url,
        function( data) {
             let feeds = data.feeds;
              $("#lastTempearature").text(feeds[24].field2+" C");
              $("#lastHumadity").text(feeds[24].field1+" %");
              $("#lastUpdate").text(feeds[24].created_at);

        $.each(feeds, (k, v)=>{

              xlabel.push(v.entry_id);
              dataH.push(v.field1);
              dataT.push(v.field2);

        });
        });  
      }

$(
    ()=>{
        let url = "https://api.thingspeak.com/channels/1458434/feeds.json?results=25";


          var plot_data = Object();
          var xlabel=[];
          var dataH=[];
          var dataT=[];
          var idH = 'myChart';  
          var idT = 'ChartMy';
          var labelH = 'Humadity';
          var labelT = 'Tempearature';
         
       
      loaddata(xlabel,dataH,dataT,url);

      showChart(dataH,xlabel,idH,labelH);

      showChart(dataT,xlabel,idT,labelT); 
      })     
  </script>
  </script>
</html>

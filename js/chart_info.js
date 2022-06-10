 // var ctx = document.getElementById("barChart")
 const ctx = document.getElementById("bar-chart").getContext("2d")// added '.getContext("2d")'

 /* const gradientFill = ctx.createLinearGradient(0, 0, 0, 290);
 
       gradientFill.addColorStop(0, "hsla(218, 71%, 35%, 1)");
       gradientFill.addColorStop(1, "hsla(218, 41%, 35%, 0.2)");
  */
 const myChart = new Chart(ctx, {
   type: "bar",
   data: {
     labels: ["Office 365", "3CX", "NETWORK", "LAPTOP", "PASSWORD RESET", "FAULTY LAPTOP", "EMAIL","EDOGOV","APP SUPPORT", "SCANNER PROBLEM"],
     datasets: [{
       label: "My Label",
       backgroundColor: [
           'rgba(255, 26, 104, 0.5)',
           'rgba(54, 162, 235, 0.5)',
           'rgba(255, 206, 86, 0.5)',
           'rgba(75, 192, 192, 0.5)',
           'rgba(153, 102, 255, 0.5)',
           'rgba(255, 159, 64, 0.5)',
           'rgba(0, 0, 0, 0.5)',
           'rgba(104, 102, 34, 0.5)',
           'rgba(111, 89, 68, 0.5)',
           'rgba(244, 183, 50, 0.5)'
         ], 
         
       borderWidth: 1,
       hoverBackgroundColor: "white",
       hoverBorderColor: "orange",
       scaleStepWidth: 1,
       data: [29, 62, 39, 47, 78, 30, 35, 50, 25, 80]
     }]
   },
 
   options: {
     plugins: {  // 'legend' now within object 'plugins {}'
       legend: {
         labels: {
           color: "blue",  // not 'fontColor:' anymore
           // fontSize: 18  // not 'fontSize:' anymore
           font: {
             size: 18 // 'size' now within object 'font {}'
           }
         }
       }
     },
     scales: {
       y: {  // not 'yAxes: [{' anymore (not an array anymore)
         ticks: {
           color: "whiteSmoke", // not 'fontColor:' anymore
           // fontSize: 18,
           font: {
             size: 14, // 'size' now within object 'font {}'
           },
           stepSize: 1,
           beginAtZero: true
         }
       },
       x: {  // not 'xAxes: [{' anymore (not an array anymore)
         ticks: {
           color: "whiteSmoke",  // not 'fontColor:' anymore
           //fontSize: 14,
           font: {
             size: 10 // 'size' now within object 'font {}'
           },
           stepSize: 1,
           beginAtZero: true
         }
       }
     }
   }
 });    
 
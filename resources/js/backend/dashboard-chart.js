var Chart = require('chart.js');
var axios = require('axios')

var chartOutstanding = document.getElementById('dashboard-chart-outstanding-notaris');
var chartOutstandingCluster = document.getElementById('dashboard-chart-outstanding-cluster');
var chartPenerimaanNotaris = document.getElementById('dashboard-chart-penerimaan-notaris');
var chartPenerimaanCluster = document.getElementById('dashboard-chart-penerimaan-cluster');
var chartStatus = document.getElementById('dashboard-chart-status');


axios.get("/ajax/dashboard/chart/outstanding").then(function (val){
  if(val.data.notaris && val.data.notaris.label.length > 0) {
    var myChart = new Chart(chartOutstanding, {
      type: 'doughnut',
      data: {
        labels: val.data.notaris.label,
        datasets: [{
          label: 'Per Notaris',
          data: val.data.notaris.data,
          backgroundColor: val.data.notaris.color
        }]
      },
      options: {
        legend: {
          // display: false
        },
        plugins: {
          title: {
            display: true,
            text: 'per notaris'
          },
          legend: {
            position: 'left'
          }
        }
      }
    });
  }
  if(val.data.cluster && val.data.cluster.label.length > 0) {
    var myChart = new Chart(chartOutstandingCluster, {
      type: 'doughnut',
      data: {
        labels: val.data.cluster.label,
        datasets: [{
          label: 'Per Cluster',
          data: val.data.cluster.data,
          backgroundColor: val.data.cluster.color
        }]
      },
      options: {
        legend: {
          // display: false
        }
      }
    });
  }
});
axios.get("/ajax/dashboard/chart/penerimaan").then(function (val){
  if(val.data.notaris && val.data.notaris.label.length > 0) {
    var myChart = new Chart(chartPenerimaanNotaris, {
      type: 'doughnut',
      data: {
        labels: val.data.notaris.label,
        datasets: [{
          label: 'Per Notaris',
          data: val.data.notaris.data,
          backgroundColor: val.data.notaris.color
        }]
      },
      options: {
        legend: {
          // display: false
        },
        plugins: {
          title: {
            display: true,
            text: 'per notaris'
          }
        }
      }
    });
  }
  if(val.data.cluster && val.data.cluster.label.length > 0) {
    var myChart = new Chart(chartPenerimaanCluster, {
      type: 'doughnut',
      data: {
        labels: val.data.cluster.label,
        datasets: [{
          label: 'Per Cluster',
          data: val.data.cluster.data,
          backgroundColor: val.data.cluster.color
        }]
      },
      options: {
        legend: {
          // display: false
        }
      }
    });
  }
});
axios.get("/ajax/dashboard/chart/status").then(function (val){
  if(val.data && val.data.label.length > 0) {
    document.getElementById('dashboard-total-status').innerHTML = val.data.total;
    var myChart = new Chart(chartStatus, {
      type: 'pie',
      data: {
        labels: val.data.label,
        datasets: [{
          label: val.total,
          data: val.data.data,
          backgroundColor: val.data.color
        }]
      },
      options: {
        legend: {
          // display: false
        },
        plugins: {
          datalabels: {
              formatter: (value, ctx) => {
                  let sum = 0;
                  let dataArr = ctx.chart.data.datasets[0].data;
                  dataArr.map(data => {
                      sum += data;
                  });
                  let percentage = (value*100 / sum).toFixed(2)+"%";
                  return percentage;
              },
              color: '#fff',
          }
        }
      }
    });
  }
  document.getElementById('loading-dashboard-chart').remove();
});














// var myChart = new Chart(chartOutstanding, {
//   type: 'pie',
//   data: {
//     labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
//     datasets: [{
//       label: '# of Votes',
//       data: [12, 19, 3, 5, 2, 3],
//       backgroundColor: [
//         'rgba(255, 99, 132, 0.2)',
//         'rgba(54, 162, 235, 0.2)',
//         'rgba(255, 206, 86, 0.2)',
//         'rgba(75, 192, 192, 0.2)',
//         'rgba(153, 102, 255, 0.2)',
//         'rgba(255, 159, 64, 0.2)'
//       ],
//       borderColor: [
//         'rgba(255, 99, 132, 1)',
//         'rgba(54, 162, 235, 1)',
//         'rgba(255, 206, 86, 1)',
//         'rgba(75, 192, 192, 1)',
//         'rgba(153, 102, 255, 1)',
//         'rgba(255, 159, 64, 1)'
//       ],
//       borderWidth: 1
//     }]
//   },
//   options: {
//     scales: {
//       y: {
//         beginAtZero: true
//       }
//     }
//   }
// });
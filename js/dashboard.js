/*Bootstrap dashboard provided Graph 
*/


(function () {
  'use strict'

  feather.replace()


  var ctx = document.getElementById('myChart')
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: [
        'Amount'
      ],
      datasets: [{
        data: [
          0,
          getCustomerAmount()
        ],
        lineTension: 0,
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        borderWidth: 4,
        pointBackgroundColor: '#007bff'
      }]
    },
    options: {
      scales: {
        yAxes: [{
          ticks: {
            beginAtZero: false
          }
        }]
      },
      legend: {
        display: false
      }
    }
  })
}())

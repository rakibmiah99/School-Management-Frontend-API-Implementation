'use strict';

const data = {
  labels: ['SUN', 'MON', 'TUE', 'WED', 'THURS', 'FRI', 'SAT'],
  datasets: [
    {
      label: 'Income',
      backgroundColor: 'rgba(54, 162, 235, 0.2)',
      borderColor: 'rgba(54, 162, 235, 1)',
      borderWidth: 2,
      data: [2, 12, 10, 12, 5, 13, 15],
    },
    {
      label: 'Expense',
      backgroundColor: 'rgba(255, 159, 64, 0.2)',
      borderColor: 'rgba(255, 159, 64, 1)',
      borderWidth: 2,
      data: [12, 2, 5, 8, 1, 4, 5],
    },
  ],
};

const config = {
  type: 'bar',
  data: data,
  options: {},
};

const myChart = new Chart(document.getElementById('myChart'), config);

document.getElementById('target').addEventListener('change', function () {
  'use strict';
  let vis = document.querySelector('.vis'),
    target = document.getElementById(this.value);
  if (vis != null) {
    vis.className = 'inv';
  }
  if (target != null) {
    target.className = 'vis';
  }
});

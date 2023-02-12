'use strict';

//SHOW NOTIFICATION MENU ON BUTTON CLICK
const notificationBtn = document.querySelector('.notification-btn');
const notificationBar = document.querySelector('.notification__sidebar');

notificationBtn.addEventListener('click', function () {
  timesClicked++;

  if (timesClicked % 2 == 0) {
    notificationBtn.classList.add('notification-btn-colored');
    notificationBar.classList.remove('hide');
    notificationBar.classList.add('show-block');
  } else {
    notificationBtn.classList.remove('notification-btn-colored');
    notificationBar.classList.add('hide');
    notificationBar.classList.remove('show-block');
  }
});

//CLOSE NOTIFICATION MENU ON BUTTON CLICK
const closeBtn = document.querySelector('.close-btn');

closeBtn.addEventListener('click', function () {
  notificationBar.classList.remove('show-block');
  notificationBar.classList.add('hide');
});

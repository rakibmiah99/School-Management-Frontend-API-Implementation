'use strict';

//SHOW NOTIFICATION MENU ON BUTTON CLICK
const notificationBtn = document.querySelector('.notification-btn');
const notificationBar = document.querySelector('.notification__sidebar');
// let timesClicked = 0;

// notificationBtn.addEventListener('click', function () {
//   timesClicked++;

//   if (timesClicked % 2 == 0) {
//     notificationBtn.classList.add('notification-btn-colored');
//     notificationBar.classList.remove('d-none');
//     notificationBar.classList.add('d-block');
//   } else {
//     notificationBtn.classList.remove('notification-btn-colored');
//     notificationBar.classList.add('d-none');
//     notificationBar.classList.remove('d-block');
//   }
// });

notificationBtn.addEventListener('click', function () {
  notificationBar.classList.remove('d-none');
  notificationBar.classList.add('d-block');
});

//CLOSE NOTIFICATION MENU ON BUTTON CLICK
const closeBtn = document.querySelector('.close-btn');

closeBtn.addEventListener('click', function () {
  notificationBar.classList.remove('d-block');
  notificationBar.classList.add('d-none');
});

//Import Homework
//UPLOAD BUTTON
document.getElementById('buttonid').addEventListener('click', openDialog);

function openDialog() {
  document.getElementById('fileid').click();
}

//UPLOAD BUTTON SHOWING FILE NAME
const uploadBtn = document.getElementById('fileid');
const infoArea = document.getElementById('file-upload-filename');

uploadBtn.addEventListener('change', showFileName);

function showFileName(event) {
  // the change event gives us the input it occurred in
  // let uploadBtn = event.target;
  let uploadBtn = event.srcElement;

  // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
  let fileName = uploadBtn.files[0].name;

  // use fileName however fits your app best, i.e. add it into a div
  infoArea.textContent = '✔Uploaded: ' + fileName;
  infoArea.classList.remove('text-danger');
  infoArea.classList.add('text-success');
}

document.getElementById('buttonid2').addEventListener('click', openDialog2);

function openDialog2() {
  document.getElementById('fileid2').click();
}

const uploadBtn2 = document.getElementById('fileid2');
const infoArea2 = document.getElementById('file-upload-filename2');

uploadBtn2.addEventListener('change', showFileName2);

function showFileName2(event) {
  // the change event gives us the input it occurred in
  // let uploadBtn2 = event.target;
  let uploadBtn = event.srcElement;

  // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
  let fileName2 = uploadBtn2.files[0].name;

  // use fileName however fits your app best, i.e. add it into a div
  infoArea2.textContent = '✔Uploaded: ' + fileName2;
  infoArea2.classList.remove('text-danger');
  infoArea2.classList.add('text-success');
}

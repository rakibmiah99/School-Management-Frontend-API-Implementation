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

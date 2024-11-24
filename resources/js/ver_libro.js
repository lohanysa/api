//document.addEventListener("DOMContentLoaded", function() {

function alertNotFound() {
    alert("libro no encontrado");
  }

function initialize() {
     var volId
     volId=document.getElementById('volId').value
    var viewer = new google.books.DefaultViewer(document.getElementById('viewerCanvas'));
    viewer.load(volId , alertNotFound);
  }
//})
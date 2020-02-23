const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
function streamer(access){
    window.stream = access;
    video.srcObject = access;
}
async function init(){
    try{
        access = await navigator.mediaDevices.getUserMedia({audio: false, video: {width: 400, height: 300}});
        streamer(access);
    }
    catch(err){
        errorMsgElement.innerHTML = `navigator.getUserMedia.error:${err.toString}`;
    }
}
init();
function btnEnable(){
    document.getElementById('save').disabled = false;
}
function btnDisable(){
    document.getElementById('save').disabled = true;
}

function drawImage(){
    var context = canvas.getContext('2d');
    context.drawImage(video, 0, 0, 400, 300);
    btnEnable();
}
function saveImage(){
    var imgString = canvas.toDataURL();
    var ajaxVar = new XMLHttpRequest();
    var context = canvas.getContext('2d');

    ajaxVar.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200){
    ajaxVar = document.getElementById("demo");
     ajaxVar.innerHTML = this.responseText;
 }
};
ajaxVar.open("POST", "save_image.php");
ajaxVar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
ajaxVar.send("base_str="+imgString);
btnDisable();
context.clearRect(0, 0, 400, 300);
}

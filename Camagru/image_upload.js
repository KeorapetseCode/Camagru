function btnEnable(){
    document.getElementById('Save').disabled = false;
}
function btnDisable(){
    document.getElementById('Save').disabled = true;
}

function btnEnablePr(){
    document.getElementById('Preview').disabled = false;
}
function btnDisablePr(){
    document.getElementById('Preview').disabled = true;
}
function uploadImage(fileSrc){

	const canvas = document.getElementById('canvas');
	const context = canvas.getContext('2d');
	const img = new Image();
	img.src = fileSrc;
	img.onload = function() {
		context.drawImage(img, 0, 0, 400, 300);
	}
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
btnEnablePr();
context.clearRect(0, 0, 400, 300);
}
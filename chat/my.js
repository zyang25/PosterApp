function getXmlHttpObject(){
	var xmlHttpRequest;
	if(window.ActiveXobjext){
		xmlHttpRequest=new ActiveXobjext("Micorsoft.XMLHTTP");
	}
	else{
		xmlHttpRequest=new XMLHttpRequest();
	}
	return xmlHttpRequest;
}
function $(id){
	return document.getElementById(id);
}
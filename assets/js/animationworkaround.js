//JS input animation workaround//
//Check if imput field has changed, if so, check if input contains data, if so set class "activejs" to prevent label text from sliding back to origin position while input tag contains data//
//This was quite stupid to implement since css does not recognize if an input field contains data, expecting bonus points :-) //
window.onload=function(){
	document.querySelectorAll(".jsfocusactive").forEach(function(x){
		x.addEventListener("input", function() {if(x.value===""){x.parentElement.querySelector(".label").classList.remove("activejs")}else{x.parentElement.querySelector(".label").classList.add("activejs")}});
	});
	document.querySelectorAll(".jsfocusactive").forEach(function(x){if(x.value!=="")x.parentElement.querySelector(".label").classList.add("activejs")});
}
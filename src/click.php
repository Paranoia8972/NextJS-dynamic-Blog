<!DOCTYPE html> 
<html lang="en"> 
<head> 
	<meta charset="UTF-8" /> 
	<meta http-equiv="X-UA-Compatible" content="IE=edge" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
	<title>Custom menu on text selection</title> 
	<link
	rel="stylesheet"
	href= 
"https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
	integrity= 
"sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p"
	crossorigin="anonymous"/> 
	<style> 
	body { 
		position: absolute; 
		top: 50%; 
		left: 50%; 
		transform: translate(-50%, -50%); 
		background: #cccccc; 
	} 
	.text { 
		width: 400px; 
		min-height: 200px; 
		background: #fff; 
		padding: 20px 50px 50px 50px; 
		position: relative; 
		display: flex; 
		flex-direction: column; 
		justify-content: center; 
		align-items: center; 
		line-height: 1.8; 
		word-spacing: 8px; 
	} 
	p { 
		margin: 0; 
	} 
	h1 { 
		user-select: none; 
		color: green; 
	} 
	.menu { 
		display: none; 
		position: absolute; 
		background: #a4a4a4; 
		border-radius: 6px; 
	} 
	.menu i { 
		color: #000; 
		cursor: pointer; 
		margin: 8px; 
	} 
	#output { 
		position: absolute; 
		opacity: 0.01; 
		height: 0; 
		overflow: hidden; 
	} 
	.popup { 
		display: none; 
		position: fixed; 
		z-index: 1; 
		left: 0; 
		top: 0; 
		width: 100%; 
		height: 100%; 
		overflow: auto; 
		background-color: rgb(0, 0, 0); 
		background-color: rgba(0, 0, 0, 0.4); 
	} 
	.popup-content { 
		background-color: #fefefe; 
		margin: 15% auto; 
		padding: 20px; 
		border: 1px solid #888; 
		width: 50%; 
		display: flex; 
		align-items: center; 
	} 
	.close-btn { 
		color: #aaa; 
		font-size: 28px; 
		font-weight: bold; 
		margin-left: auto; 
	} 
	.close-btn:hover, 
	.close-btn:focus { 
		color: black; 
		text-decoration: none; 
		cursor: pointer; 
	} 
	.popup-content p { 
		font-size: 28px; 
		font-weight: bold; 
	} 
	</style> 

	<script> 
	var pageX, pageY; 
	document.addEventListener("mouseup", () => { 
		function copyfieldvalue() { 
		var field = document.getElementById("output"); 
		field.focus(); 
		field.setSelectionRange(0, field.value.length); 
		document.execCommand("copy"); 
		} 

		let selection = document.getSelection(); 
		let selectedText = selection.toString(); 
		var menu = document.querySelector(".menu"); 
		if (selectedText !== "") { 
        let rect = document.body.getBoundingClientRect();
		menu.style.display = "block"; 
		menu.style.left = pageX - Math.round(rect.left) + "px"; 
		menu.style.top = pageY - Math.round(rect.top) - 58 + "px"; 

		document.getElementById("output").innerHTML = selectedText; 

		var popup = document.getElementById("mypopup"); 
		var copybtn = document.getElementById("copy-btn"); 

		copybtn.addEventListener("click", () => { 
			copyfieldvalue(); 
			popup.style.display = "block"; 
		}); 

		var span = document.getElementsByClassName("close-btn")[0]; 

		span.addEventListener("click", () => { 
			popup.style.display = "none"; 
		}); 

		window.addEventListener("click", (event) => { 
			if (event.target == popup) { 
			popup.style.display = "none"; 
			} 
		}); 
		} else { 
		menu.style.display = "none"; 
		} 
	}); 
    document.addEventListener("mousedown", (e) => {
    pageX = e.pageX;
    pageY = e.pageY;
});
	</script> 
</head> 
<body> 
	<div class="text"> 
	<h1>GeeksforGeeks</h1> 
	<p> 
		In today’s digital world, when there are thousands of online platforms 
		(maybe more than that!) available over the web, it becomes quite 
		difficult for students to opt for a quality, relevant and reliable 
		platform for themselves. Meanwhile, as Computer Science is a very vast 
		field hence students are required to find an appropriate platform that 
		can fulfill all their needs such as – Tutorials & Courses, Placement 
		Preparation, Interview Experiences, and various others. And with the 
		same concern, GeeksforGeeks comes in the picture – a one-stop 
		destination for all Computer Science students!! 
	</p> 

	<div class="menu"> 
		<i class="fa fa-copy fa-2x" id="copy-btn"></i> 
		<i class="fa fa-highlighter fa-2x" id="highlight-btn"></i> 
	</div> 
	<textarea id="output"></textarea> 
	<div id="mypopup" class="popup"> 
		<div class="popup-content"> 
		<p>Copied!!</p> 
		<span class="close-btn">×</span> 
		</div> 
	</div> 
	</div> 
</body> 
</html> 

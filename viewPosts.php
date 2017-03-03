
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"> </script>
<head>
	<title>"Homepage"</title>
    <meta charset = "utf-8"/>
</head>

<body>
    <h1>
        Homepage
    </h1>
    <div>
	<table id = "postlist" style="width:100%">
      <tr>
		<th>Title</th>
        <th>Description</th>
        <th>Time</th>
        <th>Update</th>
		<th style="display : none">Delete</th>
      </tr>
    </table>
	</div>
	<br/ >

     <input onCLick="" type="button" id="newpost" name="newpost" value="New Post"/>
	
	<form id="popup">
		<label>Title<input type="text" id="title" name="tile" value=""/></label>
		<br/ >
		<label>Description<input type="text" id="desc" name="desc" value=""/></label>
		<input onCLick="" type="button" id="post" name="post" value="Post"/>
	</form>

    <p id="disp"></p>
	<br/ >
	<a href="login.html">Log Out</a>
    
</body>
	
<script>
	

	
function updateTable(){
	var text = helper("users.txt");
	var obj = JSON.parse(text);
	var newJSON = {};
	for (var i = 0; i < obj.length; i++) {
  		tabBody=document.getElementsByTagName("TBODY").item(0);
		row=document.createElement("TR");
		cell1 = document.createElement("TD");
		cell2 = document.createElement("TD");
		cell3 = document.createElement("TD");
		cell4 = document.createElement("TD");
		let delButton = document.createElement('button');
		delButton.innerHTML = "Update";
		textnode1=document.createTextNode(obj[i].user);
		textnode2=document.createTextNode(obj[i].pass);
		textnode3=document.createTextNode(obj[i].time);
		cell1.appendChild(textnode1);
		cell2.appendChild(textnode2);
		cell3.appendChild(textnode3);
		cell4.appendChild(delButton);
		row.appendChild(cell1);
		row.appendChild(cell2);
		row.appendChild(cell3);
		row.appendChild(cell4);
		tabBody.appendChild(row);
	}
	
}	

$(document).ready(function() {
    $('#popup').submit(function() {
        $.ajax({
            type: "POST",
            url: 'updatePosts.php',
            data: {
				postID: -1,
                postTitle: $("#title").val(),
                postDesc: $("#desc").val()
            },
            success: function(data)
            {
                updateTable();
            }
        });
    });
});
	
function helper(f)
{
        var request = new XMLHttpRequest();
        request.open("GET", f, false);
        request.send(null);
        var returnValue = request.responseText;
        return returnValue;
}

	
	
window.onload = () => {
	updateTable();

	document.getElementById("newpost").onclick=(function(){
		var popup = document.getElementById("popup");
		popup.style.display = "block";
		
		document.getElementById("post").onclick=(function(){
			var postTitle;
			var postDesc;
			var curTime = new Date().toLocaleString();
			postTitle = document.getElementById("title").value;
			postDesc = document.getElementById("desc").value;
			popup.style.display = "none";
			document.getElementById("title").value = "";
		    document.getElementById("desc").value = "";
			
//			 row=document.createElement("TR");
//			 cell1 = document.createElement("TD");
//			 cell2 = document.createElement("TD");
//			 cell3 = document.createElement("TD");
//			 cell4 = document.createElement("TD");
//			 let delButton = document.createElement('button');
//			 delButton.innerHTML = "Update";
//			 textnode1=document.createTextNode(postTitle);
//			 textnode2=document.createTextNode(postDesc);
//			 textnode3=document.createTextNode(curTime);
//			 cell1.appendChild(textnode1);
//			 cell2.appendChild(textnode2);
//			 cell3.appendChild(textnode3);
//			 cell4.appendChild(delButton);
//			 row.appendChild(cell1);
//			 row.appendChild(cell2);
//			 row.appendChild(cell3);
//			 row.appendChild(cell4);
//			 tabBody.appendChild(row);
			
		});

	});
	
	
};

</script>
	
<style>
	
table, th, td {
    border: 1px solid black;
}	
	
#popup {
   display:none;
   position:fixed;
   left:20%;            
   top:50%;           
   width:200px;        
   height:100px;
   margin-top:-75px; 
   margin-left:-150px;  
   background:#FFFFFF;  
   border:2px solid #000;  
   z-index:100000;     
}
	
</style>

<?php
	  
?>

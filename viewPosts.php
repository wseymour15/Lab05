<?php session_start(); ?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"> </script>
<head>
	<title>"Homepage"</title>
    <meta charset = "utf-8"/>
</head>

<body>
    <h1>
        Homepage
		<p> Hello <?php echo $_SESSION["login"]; ?></p>
    </h1>
    <div>
	<table id = "posttable" style="width:100%">
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
	
	<input onCLick="" type="button" id="newmessage" name="newmessage" value="New Message"/>
	<br/ >
	<form id="goInbox" action="javascript:void(0)" method = "post"><input type="submit" id="inbox" name="inbox" value="Inbox"/></form>
	
	
	
	<form id="popup" action="javascript:void(0)" method = "post">
		<label>Title<input type="text" id="title" name="title" value=""/></label>
		<br/ >
		<label>Description<input type="text" id="desc" name="desc" value=""/></label>
		<input onCLick="" type="submit" id="post" name="post" value="Post"/>
	</form>
    
    <form id="popup1" action="javascript:void(0)" method = "post">
		<label>Title<input type="text" id="titleUp" name="titleUp" value=""/></label>
		<br/ >
		<label>Description<input type="text" id="descUp" name="descUp" value=""/></label>
		<br/ >
		<input onCLick="" type="submit" id="enterVal" name="post" value="Post"/>
	</form>
	
	<form id="mesPop" action="javascript:void(0)" method = "post">
		<label>To <br/ ><input type="text" id="toSend" name="toSend" value=""/></label>
		<br/ >
		<label>Message<input type="text" id="mesSend" name="mesSend" value=""/></label>
		<br/ >
		<input onCLick="" type="submit" id="sender" name="sender" value="Send"/>
	</form>

    <p id="disp"></p>
	<br/ >
	<a href="login.html">Log Out</a>
    
</body>
	
<script>
        function fun(){
		var popup = document.getElementById("popup1");
		popup.style.display = "block";
		
		document.getElementById("enterVal").onclick=(function(){
			var postTitle;
			var postDesc;
			var curTime = new Date().toLocaleString();
			postTitle = document.getElementById("title").value;
			postDesc = document.getElementById("desc").value;
			popup.style.display = "none";
			
		})
    }    
	function helper(f)
{
        var request = new XMLHttpRequest();
        request.open("GET", f, false);
        request.send(null);
        var returnValue = request.responseText;
        return returnValue;
}

function updateTable(obj){
//	var text = helper("po.txt");
    console.log("hello");
    var delButton;
//    console.log(text);
    if(obj !== undefined){
	//var obj = JSON.parse(text);
	for (var i = 0; i < obj.length; i++) {
  		tabBody=document.getElementsByTagName("TBODY").item(0);
		row=document.createElement("TR");
		cell1 = document.createElement("TD");
		cell2 = document.createElement("TD");
		cell3 = document.createElement("TD");
		cell4 = document.createElement("TD");
		delButton = document.createElement('button');
        delButton.onclick = (function(){fun()});
        delButton.setAttribute("id",i);
        delButton.setAttribute("name", "upBut");
		delButton.innerHTML = "Update";
		textnode1=document.createTextNode(obj[i].title);
		textnode2=document.createTextNode(obj[i].msg);
		textnode3=document.createTextNode(obj[i].tim);
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
	
}	

$(document).ready(function() {
    $('#popup').submit(function() {
        $.ajax({
            type: "POST",
            method: "post",
            url: 'updatePosts.php',
            data: {
				postID: -1,
                postTitle: $("#title").val(),
                postDesc: $("#desc").val()
            },
            success: function(data)
            {
                console.log("we out here");
                tabBody=document.getElementsByTagName("TBODY").item(0);
		row=document.createElement("TR");
		cell1 = document.createElement("TD");
		cell2 = document.createElement("TD");
		cell3 = document.createElement("TD");
		cell4 = document.createElement("TD");
		let delButton = document.createElement('button');
        delButton.setAttribute("id",data.length-1);
        delButton.setAttribute("name", "upBut");
		delButton.innerHTML = "Update";
		textnode1=document.createTextNode(data[data.length-1].title);
		textnode2=document.createTextNode(data[data.length-1].msg);
		textnode3=document.createTextNode(data[data.length-1].tim);
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
        });
    });
	
	$('#mesPop').submit(function() {
		$.ajax({
			type: "POST",
            method: "post",
            url: 'sendMessage.php',
			data: {
                recipient: $("#toSend").val(),
                messageVal: $("#mesSend").val()
            },
			success: function(data)
            {
				
			}
		});	
		
		
	});	
	
	$('#goInbox').submit(function() {
		$.ajax({
			success: function(data)
            {
                window.location.replace('inbox.php');
            }
		});	
		
		
	});	
	
});

	
	
window.onload = () => {
        $.ajax({
            method: "POST",
            url: 'updatePosts.php',
            data: {
				postID: -2,
//                postTitle: $("#title").val(),
//                postDesc: $("#desc").val()
            },
            success: function(data)
            {
                console.log(data);
                updateTable(data);
            }
        });

	document.getElementById("newpost").onclick=(function(){
		var popup = document.getElementById("popup");
		popup.style.display = "block";
		
		document.getElementById("post").onclick=(function(){
			popup.style.display = "none";
			
		});

	});
	
	
	document.getElementById("newmessage").onclick=(function(){
		var mesPop = document.getElementById("mesPop");
		mesPop.style.display = "block";
		
		document.getElementById("sender").onclick=(function(){
			mesPop.style.display = "none";
			
		});

	});
//        var elem = document.getElementsByName("upBut");
//        var n;
//        for(n = 0; n < elem.length; ++n){
//            elem[n].onclick=(function(){
//                console.log("I got clicked");
//		      var popup1 = document.getElementById("popup1");
//		      popup1.style.display = "block";
//		      document.getElementById("enterVal").onclick=(function(){
//			     var postTitle;
//			     var postDesc;
//			     var curTime = new Date().toLocaleString();
//			     postTitle = document.getElementById("titleUp").value;
//			     postDesc = document.getElementById("descUp").value;
//			     popup.style.display = "none";
//			
//		      });
//
//	       });
//        }
    
    
	
	
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
    
#popup1 {
   display:none;
   position:fixed;
   left:80%;            
   top:50%;           
   width:200px;        
   height:100px;
   margin-top:-75px; 
   margin-left:-150px;  
   background:#FFFFFF;  
   border:2px solid #000;  
   z-index:100000;     
}
	
#mesPop {
   display:none;
   position:fixed;
   left:50%;            
   top:75%;           
   width:200px;        
   height:100px;
   margin-top:-75px; 
   margin-left:-150px;  
   background:#FFFFFF;  
   border:2px solid #000;  
   z-index:100000;     
}
	
</style>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>QR Code Generator</title>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI',sans-serif;
}

body{
    background:#f5f6fa;
    padding:40px;
}

.container{
    max-width:1200px;
    margin:auto;
}

.title{
    text-align:center;
    margin-bottom:30px;
}

.title h1{
    color:#1f2937;
    font-size:42px;
}

.title p{
    color:#6b7280;
    margin-top:8px;
}
.logo{
    font-size:60px;
    margin-bottom:10px;
}

.line{
    width:80px;
    height:4px;
    background:#7c3aed;
    margin:15px auto;
    border-radius:20px;
}

.card{
    background:#faf8ff;
    padding:30px;
    border-radius:20px;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
}

.form-row{
    display:flex;
    gap:15px;
    flex-wrap:wrap;
}

input{
    flex:1;
    min-width:300px;
    padding:14px;
    border:1px solid #ddd;
    border-radius:10px;
    font-size:15px;
}

select{
    padding:14px;
    border:1px solid #ddd;
    border-radius:10px;
    min-width:220px;
}

button{
    padding:14px 25px;
    border:none;
    border-radius:10px;
    cursor:pointer;
    font-weight:600;
}
.generate-btn{
    background:linear-gradient(
    90deg,
    #7c3aed,
    #9333ea
    );
    color:white;
}

.generate-btn:hover{
    background:#6d28d9;
}

.clear-btn{
    background:white;
    color:#7c3aed;
    border:2px solid #7c3aed;
}

.clear-btn:hover{
    background:#f3e8ff;
}

.download-btn{
    background:#16a34a;
    color:white;
    text-decoration:none;
    display:none;
}

.download-btn:hover{
    background:#15803d;
}

.action-area{
    text-align:center;
    margin-top:20px;
}

#qrCode{
    display:flex;
    justify-content:center;
    margin-top:25px;
}

#qrCode img{
    background:white;
    padding:15px;
    border-radius:15px;
    box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.history-title{
    margin-top:40px;
    margin-bottom:15px;
    font-size:28px;
    color:#1f2937;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 5px 20px rgba(0,0,0,0.08);
}
th{
    background:linear-gradient(90deg,#7c3aed,#8b5cf6);
    color:white;
    padding:15px;
    font-weight:600;
}

td{
    padding:15px;
    border-bottom:1px solid #eee;
    text-align:center;
}

.preview{
    width:70px;
}

.history-download{
    background:#7c3aed;
    color:white;
    padding:8px 15px;
    border-radius:8px;
    text-decoration:none;
}

.history-download:hover{
    background:#6d28d9;
}

@media(max-width:768px){

.form-row{
    flex-direction:column;
}

input,
select,
button{
    width:100%;
}

}

</style>
</head>

<body>

<div class="title">

<div class="logo">📱</div>

<h1>QR Code Generator</h1>

<p>Create, Preview & Download QR Codes Instantly</p>

<div class="line"></div>

</div>

<div class="card">

<div class="form-row">

<input
type="text"
id="textInput"
placeholder="Enter URL or Text">

<select id="qrSize">
<option value="150">Small (150x150)</option>
<option value="200" selected>Medium (200x200)</option>
<option value="300">Large (300x300)</option>
</select>

<button
class="generate-btn"
onclick="generateQR()">
Generate QR
</button>

</div>

<div id="qrCode"></div>

<div class="action-area">

<a id="downloadBtn"
class="download-btn">
Download Current QR
</a>

<br><br>

<button
class="clear-btn"
onclick="clearHistory()">
Clear History
</button>

</div>

</div>

<h2 class="history-title">
QR History
</h2>

<table>

<thead>
<tr>
<th>Text / URL</th>
<th>QR Preview</th>
<th>Date & Time</th>
<th>Download</th>
</tr>
</thead>

<tbody id="historyTable">
</tbody>

</table>

</div>

<script>

function generateQR(){

let text=document.getElementById("textInput").value.trim();

let size=parseInt(
document.getElementById("qrSize").value
);

if(text===""){
alert("Please enter URL or Text");
return;
}

document.getElementById("qrCode").innerHTML="";

new QRCode(
document.getElementById("qrCode"),
{
text:text,
width:size,
height:size
}
);

setTimeout(()=>{

let img=document.querySelector("#qrCode img");

if(img){

fetch("save_qr.php",{
    method:"POST",
    headers:{
        "Content-Type":"application/x-www-form-urlencoded"
    },
    body:
    "text="+encodeURIComponent(text)+
    "&image="+encodeURIComponent(img.src)
})
.then(response=>response.text())
.then(data=>console.log(data));

let btn=document.getElementById("downloadBtn");

btn.href=img.src;
btn.download="qrcode_"+Date.now()+".png";

btn.style.display="inline-block";

loadHistory();

document.getElementById("textInput").value="";

}

},500);

}

function clearHistory() {

    if (!confirm("Are you sure you want to clear all history?")) {
        return;
    }

    fetch("clear_history.php")
    .then(response => response.text())
    .then(data => {

        alert("History Cleared Successfully!");

        document.getElementById("historyTable").innerHTML = "";
        document.getElementById("qrCode").innerHTML = "";

        location.reload();

    })
    .catch(error => {
        alert("Error clearing history");
        console.log(error);
    });

}

function clearHistory() {

    if (!confirm("Are you sure you want to clear all history?")) {
        return;
    }

    fetch("clear_history.php")
    .then(response => response.text())
    .then(data => {

        alert("History Cleared Successfully!");

        document.getElementById("historyTable").innerHTML = "";
        document.getElementById("qrCode").innerHTML = "";

        location.reload();

    })
    .catch(error => {
        alert("Error clearing history");
        console.log(error);
    });

}

loadHistory();

</script>

</body>
</html>

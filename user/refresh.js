  var auto_refresh = setInterval(                                   	   
    function () {
    $('#Status').load('window.php');
    },3000); 

    //now it is set to 3seconds. You can change it to any value as you wish. but remember faster refresh rate takes more load from server
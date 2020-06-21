// Generate a new random MQTT client id on each page load
clientID = "clientID_" + parseInt(Math.random() * 100);
// Create a MQTT client instance
client = new Paho.MQTT.Client("test.mosquitto.org", 8081, clientID);

// Tell the client instance to connect to the MQTT broker
client.connect({ onSuccess: myClientConnected });

// Variables for calculating HAR and IBAA
var cont = 0
var contSDx = 0
var contPie = 0
var contSentado = 0

// This is the function which handles subscribing to topics after a connection is made
function myClientConnected() {
  
  client.subscribe("pruebas/iot_tutorial/from_beagle");
}

// This is the function which handles received messages
function myMessageArrived(message) {
  // Get the payload
  var messageBody = message.payloadString;

  console.log("aqui MQTT ", messageBody)
  // Create a new HTML element wrapping the message payload
  var messageHTML = $("<p>"+messageBody+"</p>");
  
  misEjes = messageBody.slice(1, messageBody.length-1)
  var arrayEjes = misEjes.split(",")
  var axisX = arrayEjes[0]
  var axisY = arrayEjes[1]
  var axisZ = arrayEjes[2]
  var SDx = arrayEjes[3]
  var incX = arrayEjes[3]
  var fecha = arrayEjes[5]

  function HAR_IBAA (SDx, incX, fecha) {
	i++

	if (i < 2160){ //3 horas de ejercicio
		if (SDx > 0.1){ //caminando
			contSDx++
		}
		else {
			if (incX > 85) { //de pie
				contPie++
			}
			else{ // sentado
				contSentado++
			}
		}
	}	
	else {
		var perCam, perPie, perSen, ibaa, ibaaString
		perCam = 0.046 * contSDx
		perPie = 0.046 * contPie
		perSen = 0.046 * contSentado

		if (this.result < 25){
			ibaa = 0
			ibaaString = "Nula"
		} 
		else if (this.result >= 26 && this.result <= 50){ 
			ibaa = 5
			ibaaString = "Baja"
		}
		else if (this.result >= 51 && this.result <= 75) {
			ibaa = 10
			ibaaString = "Moderada"
		}
		else {
			ibaa = 15
			ibaaString = "Alta"
		}	

		var mysql = require('mysql');

		var con = mysql.createConnection({
			host: "localhost",
			user: "tfg",
			password: "tfg",
			database: "tfg"
		});

		con.connect(function(err) {
			if (err) throw err;
			console.log("Connected!");
			var sql = "INSERT INTO actividad (idPaciente, fecha, caminar, pie, sentado, ibaa, actividad) VALUES ?";
			var values = [idPaciente, fecha, perCam, perPie, perSen, ibaa, ibaaString]
			con.query(sql, [values], function (err, result) {
				if (err) throw err;
				console.log("1 record inserted");
			});
		});

		i = 0
		contSDx= 0
		contPie= 0
		contSentado = 0

	}
	

  }

  console.log(messageBody)
  console.log(axisX)
  console.log(axisY)
  console.log(axisZ)

  var time = new Date();
  
	Plotly.plot('chart',[{
		x: [time],
	    y: [axisX],
	    name: 'eje X',
  		mode: 'lines',
  		line: {color: '#80CAF6'}
	}, {
		x: [time],
  		y: [axisY],
  		name: 'eje Y',
  		mode: 'lines',
  		line: {color: '#DF56F1'}
  	}, {
  		x: [time],
  		y: [axisZ],
  		name: 'eje Z',
  		mode: 'lines',
  		line: {color: '#AAAAAA'}

	}]);

	var cnt = 0;
	var interval = setInterval(function(){
		var time = new Date();

		var update = {
			x: [[time], [time], [time]], 
			y:[[axisX],[axisY], [axisZ]]
		}
		var olderTime = time.setMinutes(time.getMinutes() - 1);
  		var futureTime = time.setMinutes(time.getMinutes() + 1);

  		var minuteView = {
        	xaxis: {
          		type: 'date',
          		range: [olderTime,futureTime]
        	}
      	};
      	Plotly.relayout('chart', minuteView);
	    
	    Plotly.extendTraces('chart',update, [0,1,2]);

	    if(cnt === 100) clearInterval(interval);
	}, 5000);

  console.log("aqui si me llega")
  // Insert it inside the ```id=updateMe``` element above everything else that is there 
  $("#updateMe").prepend(messageHTML);
};

// Tell MQTT_CLIENT to call myMessageArrived(message) each time a new message arrives
client.onMessageArrived = myMessageArrived;



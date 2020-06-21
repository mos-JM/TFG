function rand() {
  return Math.random();
}

var time = new Date();

var data = [{
  x: [time],
  y: [rand()],
  mode: 'lines',
  line: {color: '#80CAF6'}
}, {
  x: [time],
  y: [rand()],
  mode: 'lines',
  line: {color: '#DF56F1'}
}];


Plotly.plot('graph', data);

var cnt = 0;

var interval = setInterval(function() {

  var time = new Date();

  var update = {
  x:  [[time], [time]],
  y: [[rand()], [rand()]],
  }

  Plotly.extendTraces('graph', update, [0,1])

  if(cnt === 100) clearInterval(interval);
}, 1000);
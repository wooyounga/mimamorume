var http = require('http');

var options = {
    hostname: 'localhost',
    port: '8888'
};

function handleResponse(response){//서버의 응답을 받았을 때 발생하는 response 이벤트
    console.log("push");
}

http.request(options, function(response){//1
    handleResponse(response);
}).end();



var FCM = require('fcm-push');
var serverKey = 'AAAAocsFlMQ:APA91bG92-CCrBOYOk2LTLyffzFOIZf_k0dtS7vO4-G5c0oNXjggxp0gKRHwTHA4m4erWvV4TMh7GYqPgI-IKhu5boFpnYu5QeeGW8nHrcYme1fR02znhK2AW581qQRIzY5Fq7CwhFfJ';
var fcm = new FCM(serverKey);
var pushMessageBody = process.argv[1];

var message = {
    to: 'fEZMdm8vUz0:APA91bFEwEeP9qyOAp0wZt-fPvMs_z3gD7hwMZHXx8E8xC5S5Bz_ew47y_B8ekuTMBFBgbS6lw1wQhOTCPVX1am4-sd_JJ_9dLCPiwVJV326yd1gd6CYU7K_5w5q4cwFZcIHs5jUJ7BR',
    collapse_key: 'com.example.bon.project_7',

    notification: {
        title: '미마모루메';
        body: pushMessageBody
    }
}

fcm.send(message)
    .then(function(response) {
        console.log("Success send message");
    })
    .catch(function(err) {
        console.log("Occurred error");
    });

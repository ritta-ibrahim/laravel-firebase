
const firebaseConfig = {
    apiKey: "<YOUR-API-KEY>",
    authDomain: "<YOUR-AUTH-DOMAIN>",
    projectId: "<YOUR-PROJECT-ID>",
    storageBucket: "YOUR-STORAGE-BUCKET",
    messagingSenderId: "<YOUR-MESSAGING-SENDER-ID>",
    appId: "<YOUR-APP-ID>"
};
firebase.initializeApp(firebaseConfig);
const messaging = firebase.messaging();

function saveFcmTokent() {
    messaging
        .requestPermission()
        .then(function () {
            return messaging.getToken()
        })
        .then(function (response) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '/firebase/store',
                type: 'POST',
                data: {
                    token: response,
                },
                dataType: 'JSON',
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                },
            });
        }).catch(function (error) {
            console.log(error);
        });
}
messaging.onMessage(function (payload) {
    const title = payload.notification.title;
    const options = {
        body: payload.notification.body,
        icon: payload.notification.icon,
    };
    new Notification(title, options);
});
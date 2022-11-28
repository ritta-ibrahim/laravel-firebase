# laravel-firebase
Laravel integration with firebase legacy real-time notification (Cloud Messaging).


### Getting Started
To add real-time notifications to your project you have to add the following code filled by your data as it shown in the next section.

	1. Import the jquery library to the project.
	2. After that import firebase js library.
	3. Place the initial code in the main layout to be able to access it from anywhere.
  4. Prepare the configuration by following the next section.
	5. Call the **saveFcmTokent** Javascript function to get the required token for the device to be able to receive notifications.
	6. Now you can send your real-time notification with this token by calling the send function.

In order to get the firebase token, using getToken() function, we have to pass multi parameters to initialize the messaging instance, therefore you need to do the following steps:

	1. Login to firebase website and create a new project in firebase console at [Firebase Console](https://console.firebase.google.com/).
	2. In the creating process, disable the analytic option to get right to the point, then hit create.
	3. You'll be redirected to the project settings page, which you can get to by clicking on the project name in your main console page.
	4. Under your project create a web app, fill the name and hit register the app.
	5. While creating the app, in **Add firebase SDK** choose to use <script> tag option and continue.
	6. In the page where you created the app, click on you’re app to get to the settings, and scroll down to your app, there you'll find your app **configuration**.
	7. Now jump to Cloud Messaging tap, you'll see the api v1 enabled and the legacy disabled, hit the options button of the legacy choice and click on manage API in Google Cloud Console and then click enable.
	8. Get back and refresh the cloud messaging page. You must find the legacy enabled with a server key.
	9. Get your server key and add it to your requests as the code shown.


## Final Notes
The legacy version of firebase is not the recommended option over v1, yet it's fast, light and easy to integrate with.

## License
 laravel-firebase is MIT licensed, as found in the [LICENSE](https://github.com/ritta-ibrahim/laravel-firebase/blob/HEAD/LICENSE) file

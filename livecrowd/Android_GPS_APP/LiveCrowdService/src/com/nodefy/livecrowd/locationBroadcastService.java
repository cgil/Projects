package com.nodefy.livecrowd;

import java.util.Timer;
import java.util.TimerTask;

import us.monoid.web.DownloadTask;
import us.monoid.web.UrlCallback;
import android.app.Service;
import android.content.Context;
import android.content.Intent;
import android.location.Location;
import android.location.LocationListener;
import android.location.LocationManager;
import android.os.Binder;
import android.os.Bundle;
import android.os.IBinder;
import android.util.Log;
import android.widget.Toast;

public class locationBroadcastService extends Service {
	private String userName;
	private String eventName;
	private String lat = "0.0";
	private String lon = "0.0";
	private LocationManager locmgr = null;
	private Location curLocation = null;
	

	// Unique Identification Number for the Notification.
	// We use it on Notification start, and to cancel it.
	/**
	 * Class for clients to access.  Because we know this service always
	 * runs in the same process as its clients, we don't need to deal with
	 * IPC.
	 */
	public class LocalBinder extends Binder {
		locationBroadcastService getService() {
			return locationBroadcastService.this;
		}
	}

	@Override
	public void onCreate() {
	}

	@Override
	public int onStartCommand(Intent intent, int flags, int startId) {
		Log.i("LocalService", "Received start id " + startId + ": " + intent);
		userName = intent.getStringExtra("username");
		eventName = intent.getStringExtra("eventname");
		
		locmgr = (LocationManager) getSystemService(Context.LOCATION_SERVICE);
		LocationListener onLocationChange=new LocationListener() {
	        public void onLocationChanged(Location loc) {
	            //sets and displays the l/controllerat/long when a location is provided

	        	curLocation = loc;
	            lat = "" + curLocation.getLatitude();
	            lon = "" + curLocation.getLongitude();
				
				new DownloadTask("http://nodefy.com/livecrowd/controllers/parser.php?event="+ eventName +"&ustreamUID=" + userName + "&latitude=" +lat + "&longitude=" + lon  , new UrlCallback() {

	    			public void onDownload(String data) {
	    				// TODO Auto-generated method stub
	    				Context context = getApplicationContext();
	    				//CharSequence text = "Hello toast!";
	    				int duration = Toast.LENGTH_LONG;

	    				Toast toast = Toast.makeText(context, data, duration);
	    				toast.show();

	    			}

	    		});
	        }
	         
	        public void onProviderDisabled(String provider) {
	        // required for interface, not used
	        }
	         
	        public void onProviderEnabled(String provider) {
	        // required for interface, not used
	        }

			public void onStatusChanged(String arg0, int arg1, Bundle arg2) {
				// TODO Auto-generated method stub
				
			}
	    };
	    
	    locmgr.requestLocationUpdates(LocationManager.NETWORK_PROVIDER, 0, 0, onLocationChange);
	    

		
		// We want this service to continue running until it is explicitly
		// stopped, so return sticky.
		return START_STICKY;
	}

	@Override
	public void onDestroy() {
		// Cancel the persistent notification.

		// Tell the user we stopped.
	}

	@Override
	public IBinder onBind(Intent intent) {
		return mBinder;
	}

	// This is the object that receives interactions from clients.  See
	// RemoteService for a more complete example.
	private final IBinder mBinder = (IBinder) new LocalBinder();

	/**
	 * Show a notification while this service is running.
	 */
}


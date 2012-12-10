package com.nodefy.livecrowd;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.text.Editable;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

public class LiveCrowdServiceActivity extends Activity {
    /** Called when the activity is first created. */
    String uid = "";
    String eventName = "";
    String location = "";
    
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.main);
        
        final EditText nameText = (EditText) findViewById(R.id.userNameInput);
        final EditText eventText = (EditText) findViewById(R.id.eventNameInput);
        final Button button = (Button) findViewById(R.id.goButton);

        
        button.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Editable tempString = nameText.getText();
                uid = tempString.toString();
                tempString = eventText.getText();
                eventName = tempString.toString();
                Intent serviceIntent = new Intent(LiveCrowdServiceActivity.this, locationBroadcastService.class);
                serviceIntent.putExtra("username", uid);
                serviceIntent.putExtra("eventname", eventName);
                startService(serviceIntent);
            }
        });
    }
    
    
}